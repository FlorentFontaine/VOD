<?php

namespace App\Repository;

use App\Entity\Movie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Movie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Movie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Movie[]    findAll()
 * @method Movie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MovieRepository extends ServiceEntityRepository
{

    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Movie::class);
    }

    

    public function findAllSearch($value){
        return $this->createVisibleQuery()
        ->where('m.title = :val', 
                 'm.temps= :val')
        ->getQuery()
        ->getResult()
    ;
    }

    public function findAllVisibleQuery(){
        return $this->createVisibleQuery()
        ->getQuery()
        ->getResult()
    ;
    }

    public function findLatest(){
        return $this->createVisibleQuery()
        ->setMaxResults(4)
        ->getQuery()
        ->getResult()
    ;
    }

    private function createVisibleQuery(){
        return $this->createQueryBuilder('m')
                    ->where('m.vu = 0');
    }
    
    // /**
    //  * @return Movie[] Returns an array of Movie objects
    //  */
    public function findByExampleField($value)    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Movie
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
