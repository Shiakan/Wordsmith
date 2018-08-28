<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

   
    public function findParticipants($room, $user): ?User
    {
        return $this->createQueryBuilder('u')
            ->where(':room MEMBER OF u.playerRooms')
            ->andWhere('u.id = :userId')
            ->setParameters(array("room" => $room, "userId" => $user))
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    /**
     * @return User[] Returns an array of User objects
     */
    public function findUserByPage($page,$limit)
    {
         $offset = ($page == 0)? 0 : ($page-1) * $limit;

         $qb = $this->createQueryBuilder('u')
        ->addSelect('COUNT(u) AS HIDDEN mycount')
        ->groupBy('u')
        ->orderBy('u.id', 'ASC')
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
        
        $qb = $this->createQueryBuilder('u')
        ->select('COUNT(u)')
        ->getQuery()
        ->getSingleScalarResult(); //Retourne un chiffre
        ;
        return $qb;
    }
       /**
     * @return User[] Returns an array of User objects
     */
    public function findBySearch($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username LIKE :searching')
            ->setParameter('searching','%'.$username.'%')
            ->orderBy('u.dateInserted', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
