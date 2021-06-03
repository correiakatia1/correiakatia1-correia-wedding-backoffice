<?php

namespace App\Repository;

use App\Entity\DressCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DressCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method DressCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method DressCategory[]    findAll()
 * @method DressCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DressCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DressCategory::class);
    }

    // /**
    //  * @return DressCategory[] Returns an array of DressCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DressCategory
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
