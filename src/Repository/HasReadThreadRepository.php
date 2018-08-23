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
    
    public function findTimeStamp($user, $thread): ?HasReadThread
    {
        return $this->createQueryBuilder('h')
            ->where('h.user = :user')
            ->andWhere('h.thread = :thread')
            ->setParameters(array('user'=> $user, 'thread' => $thread))
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    /**
     * @return HasReadThread[] Returns an array of HasReadThread objects
     */
    public function findByUserAndThread($user, $thread)
    {
        return $this->createQueryBuilder('h') //On créé une requete sql qui cherche tous les hasreadthread
            ->where('h.user = :user') //Qui ont pour user id celui du user qui visite actuellement la page
            ->andWhere('h.thread = :thread') //Qui ont pour thread_id celui des threads dans la subcategory que l'on visite
            ->setParameters(array('user'=> $user, 'thread' => $thread)) //On définit les paramètres précédemment sortie soit user est $user et thread est un array de $threads
            ->orderBy('h.id', 'ASC')//On range les threads par id croissant
            ->getQuery()
            ->getResult()
            ;
    }
    /**
     * @return HasReadThread[] Returns an array of HasReadThread objects
     */
    public function findByUser($user) 
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.user = :user')
            ->setParameter('user', $user)
            ->orderBy('h.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
   
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