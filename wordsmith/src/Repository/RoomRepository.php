<?php

namespace App\Repository;

use App\Entity\Room;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Room|null find($id, $lockMode = null, $lockVersion = null)
 * @method Room|null findOneBy(array $criteria, array $orderBy = null)
 * @method Room[]    findAll()
 * @method Room[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Room::class);
    }

//    /**
//     * @return Room[] Returns an array of Room objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Room
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
        /**
         * @return Room[] Returns an array of Room objects
         */
        public function findByAll($page,$limit)
    {
         $offset = ($page == 0)? 0 : ($page-1) * $limit;

         $qb = $this->createQueryBuilder('r')
        ->addSelect('COUNT(r) AS HIDDEN mycount')
        ->groupBy('r')
        ->orderBy('r.id', 'DESC')
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
        
        $qb = $this->createQueryBuilder('r')
        ->select('COUNT(r)')
        ->getQuery()
        ->getSingleScalarResult(); //Retourne un chiffre
        ;
        return $qb;
    }
}
