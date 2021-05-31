<?php

namespace App\Repository;

use App\Entity\AccessoryCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AccessoryCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccessoryCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccessoryCategory[]    findAll()
 * @method AccessoryCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccessoryCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccessoryCategory::class);
    }

    // /**
    //  * @return AccessoryCategory[] Returns an array of AccessoryCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AccessoryCategory
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
