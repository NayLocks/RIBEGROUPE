<?php

namespace App\Repository;

use App\Entity\FicheArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FicheArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheArticle[]    findBy(array $criteria, array $orderBy, $limit = null, $offset = null)
 */
class FicheArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheArticle::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(FicheArticle $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(FicheArticle $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAll()
    {
        return $this->createQueryBuilder('c')
            ->join('c.company', 'r')
            ->orderBy('r.name, c.date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return FicheArticle[] Returns an array of FicheArticle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FicheArticle
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
