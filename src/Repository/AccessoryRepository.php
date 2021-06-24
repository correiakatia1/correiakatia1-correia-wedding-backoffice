<?php

namespace App\Repository;

use App\Entity\Accessory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Accessory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Accessory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Accessory[]    findAll()
 * @method Accessory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccessoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Accessory::class);
    }

    /**
     * @param Accessory $accessory
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Accessory $accessory)
    {
        $this->getEntityManager()->persist($accessory);
        $this->getEntityManager()->flush();
    }
    public function remove(Accessory $accessory) {
        $this->getEntityManager()->remove($accessory);
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
