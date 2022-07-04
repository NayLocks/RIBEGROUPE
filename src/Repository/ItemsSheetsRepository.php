<?php

namespace App\Repository;

use App\Entity\ItemsSheets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ItemsSheets|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItemsSheets|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItemsSheets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItemsSheetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItemsSheets::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ItemsSheets $entity, bool $flush = true): void
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
    public function remove(ItemsSheets $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAll()
    {
        return $this->createQueryBuilder('i')
            ->orderBy('i.step', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return ItemsSheets[] Returns an array of ItemsSheets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ItemsSheets
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
