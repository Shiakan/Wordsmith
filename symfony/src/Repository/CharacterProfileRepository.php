<?php

namespace App\Repository;

use App\Entity\CharacterProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CharacterProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterProfile[]    findAll()
 * @method CharacterProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterProfileRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CharacterProfile::class);
    }

//    /**
//     * @return CharacterProfile[] Returns an array of CharacterProfile objects
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
    public function findOneBySomeField($value): ?CharacterProfile
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
