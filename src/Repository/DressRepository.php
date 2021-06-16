<?php

namespace App\Repository;

use App\Entity\Dress;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
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

    /**
     * @param Dress $dress
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Dress $dress)
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
