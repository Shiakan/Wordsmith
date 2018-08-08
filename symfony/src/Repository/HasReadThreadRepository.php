<?php

namespace App\Repository;

use App\Entity\HasReadThread;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HasReadThread|null find($id, $lockMode = null, $lockVersion = null)
 * @method HasReadThread|null findOneBy(array $criteria, array $orderBy = null)
 * @method HasReadThread[]    findAll()
 * @method HasReadThread[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HasReadThreadRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HasReadThread::class);
    }

//    /**
//     * @return HasReadThread[] Returns an array of HasReadThread objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HasReadThread
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
