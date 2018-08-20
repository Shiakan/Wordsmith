<?php
namespace App\Repository;
use App\Entity\Thread;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
/**
 * @method Thread|null find($id, $lockMode = null, $lockVersion = null)
 * @method Thread|null findOneBy(array $criteria, array $orderBy = null)
 * @method Thread[]    findAll()
 * @method Thread[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ThreadRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Thread::class);
    }
//    /**
//     * @return Thread[] Returns an array of Thread objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
    /*
    public function findOneBySomeField($value): ?Thread
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
    * @return Thread[] Returns an array of Thread objects
    */
    public function findByAll($page,$limit,$subcategory,$user)
    {
         $offset = ($page == 0)? 0 : ($page-1) * $limit; //Définition de offset via un calcul
         $qb = $this->createQueryBuilder('t') //On créé une query qui séléctionne tous les threads
            ->where('t.subcategory = :subcategory')//Ou subcategory  est égale au parametre :subcategory
            ->leftJoin('t.hasReadThreads','h')
            ->setParameters(array('subcategory' => $subcategory))
            ->addSelect('COUNT(t) AS HIDDEN mycount')
            ->groupBy('t')
            ->orderBy('t.createdAt', 'DESC')
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
    public function findCountMax($subcategory)
    // Fonction qui compte le nombre total de question dans la BDD (toutes ou les non-bans)
    {
        
        $qb = $this->createQueryBuilder('t')
            ->where('t.subcategory = :subcategory')
            ->setParameter('subcategory', $subcategory)
            ->select('COUNT(t)')
            ->getQuery()
            ->getSingleScalarResult(); //Retourne un chiffre
        ;
        return $qb;
    }
}