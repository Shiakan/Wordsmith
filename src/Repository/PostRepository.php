<?php
namespace App\Repository;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Post::class);
    }

    /**
     * @return Post[] Returns an array of Post objects
     */
    public function findLastFive($thread)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.thread = :thread')
            ->setParameter('thread', $thread)
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findByThread($thread): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.thread = :thread')
            ->setParameter('thread', $thread)
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findLastPost($subcategory): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.subcategory = :subcategory')
            ->setParameter('subcategory', $subcategory)
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
    
    /**
     * @return Post[] Returns an array of Post objects
     */
        public function findByAll($page,$limit,$thread)
    {
        $offset = ($page == 0)? 0 : ($page-1) * $limit;
        $qb = $this->createQueryBuilder('p')
        ->where('p.thread = :thread')
        ->setParameter('thread', $thread)
        ->addSelect('COUNT(p) AS HIDDEN mycount')
        ->groupBy('p')
        ->orderBy('p.createdAt', 'ASC')
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
    public function findCountMax($thread)
    // Fonction qui compte le nombre total de question dans la BDD (toutes ou les non-bans)
    {
        
        $qb = $this->createQueryBuilder('p')
        ->where('p.thread = :thread')
        ->setParameter('thread', $thread)
        ->select('COUNT(p)')
        ->getQuery()
        ->getSingleScalarResult(); //Retourne un chiffre
        ;
        return $qb;
    }
}