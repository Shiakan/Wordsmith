<?php

namespace App\Repository;

use App\Entity\HasReadSubcategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HasReadSubcategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method HasReadSubcategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method HasReadSubcategory[]    findAll()
 * @method HasReadSubcategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HasReadSubcategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HasReadSubcategory::class);
    }

//    /**
//     * @return HasReadSubcategory[] Returns an array of HasReadSubcategory objects
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

        
    public function findHasRead($user, $subcategory): ?HasReadSubcategory
    {
        return $this->createQueryBuilder('h')
            ->where('h.user = :user')
            ->andWhere('h.subcategory = :subcategory')
            ->setParameters(array('user'=> $user, 'subcategory' => $subcategory))
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?HasReadSubcategory
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
