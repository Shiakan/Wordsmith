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
    public function findLastSix()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.dateInserted', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
    }
    /**
     * @return Article[] Returns an array of Article objects
     */
    public function findByAll($page,$limit)
    {
         $offset = ($page == 0)? 0 : ($page-1) * $limit;

         $qb = $this->createQueryBuilder('a')
        ->addSelect('COUNT(a) AS HIDDEN mycount')
        ->groupBy('a')
        ->orderBy('a.dateInserted', 'DESC')
        ->setFirstResult( $offset )
        ->setMaxResults( $limit )
        ->getQuery()
        ->getResult()
        ;
        return $qb;
    }
     /**
    * @return Integer
    */
    public function findCountMax()
    // Fonction qui compte le nombre total de question dans la BDD (toutes ou les non-bans)
    {
        
        $qb = $this->createQueryBuilder('a')
        ->select('COUNT(a)')
        ->getQuery()
        ->getSingleScalarResult(); //Retourne un chiffre
        ;
        return $qb;
    }

       /**
     * @return Article[] Returns an array of Article objects
     */
    public function findBySearch($title)
    {
        return $this->createQueryBuilder('a')
            ->where('a.title LIKE :searching')
            ->setParameter('searching','%'.$title.'%')
            ->orderBy('a.dateInserted', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
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
