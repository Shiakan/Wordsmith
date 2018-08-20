<?php

namespace App\Repository;

use App\Entity\Charactersheet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Charactersheet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Charactersheet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Charactersheet[]    findAll()
 * @method Charactersheet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharactersheetRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Charactersheet::class);
    }

//    /**
//     * @return Charactersheet[] Returns an array of Charactersheet objects
//     */
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
    public function findOneBySomeField($value): ?Charactersheet
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
