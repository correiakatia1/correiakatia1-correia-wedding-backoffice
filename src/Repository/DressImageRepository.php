<?php

namespace App\Repository;

use App\Entity\DressImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DressImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method DressImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method DressImage[]    findAll()
 * @method DressImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DressImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DressImage::class);
    }

    /**
     * @param DressImage $dress
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(DressImage $dress)
    {
        $this->getEntityManager()->persist($dress);
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
}
