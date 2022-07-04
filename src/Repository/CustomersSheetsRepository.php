<?php

namespace App\Repository;

use App\Entity\CustomersSheets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CustomersSheets|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomersSheets|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomersSheets[]    findAll()
 * @method CustomersSheets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomersSheetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CustomersSheets::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CustomersSheets $entity, bool $flush = true): void
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
    public function remove(CustomersSheets $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return CustomersSheets[] Returns an array of CustomersSheets objects
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
    public function findOneBySomeField($value): ?CustomersSheets
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
