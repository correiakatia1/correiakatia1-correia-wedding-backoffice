<?php

namespace App\Repository;

use App\Entity\Dress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dress|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dress|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dress[]    findAll()
 * @method Dress[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DressRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dress::class);
    }

    // /**
    //  * @return Dress[] Returns an array of Dress objects
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
    public function findOneBySomeField($value): ?Dress
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
