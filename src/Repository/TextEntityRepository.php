<?php

namespace App\Repository;


use App\Entity\TextEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TextEntityRepository extends ServiceEntityRepository
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TextEntity::class);
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getOneByHash(string $hash)
    {
        return $this->createQueryBuilder('te')
            ->where('te.textHash = :hash')
            ->setParameter('hash', $hash)
            ->getQuery()->getOneOrNullResult();
    }

    /**
     * @param string $hashes
     * @return TextEntity[]|null
     */
    public function findByHash(string $hashes)
    {
        return $this->createQueryBuilder('te')
            ->where('te.textHash IN (:hashes)')
            ->setParameter('hashes', $hashes)
            ->getQuery()->getResult();
    }
}