<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @return Article[] Returns an array of Article objects
     */
    public function findLastFive()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.dateInserted', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
   //     /**
    // * @return Article[] Returns an array of Article objects
     //*/
    /*public function findByTag($tags)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.tags.id = :tags.id')
            ->setParameter('tags.id', $tags)
            ->orderBy('a.dateInserted', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
*/
    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
