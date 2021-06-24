<?php

namespace App\Repository;

use App\Entity\AccessoryImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AccessoryImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccessoryImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccessoryImage[]    findAll()
 * @method AccessoryImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccessoryImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccessoryImage::class);
    }

    // /**
    //  * @return AccessoryImage[] Returns an array of AccessoryImage objects
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
    public function findOneBySomeField($value): ?AccessoryImage
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function create(AccessoryImage $accessoryImage)
    {
        $this->getEntityManager()->persist($accessoryImage);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }
    /**
     * @param AccessoryImage $accessoryImage
     * @throws ORMException
     */
    public function remove(AccessoryImage $accessoryImage) {
        $this->getEntityManager()->remove($accessoryImage);
    }
}
