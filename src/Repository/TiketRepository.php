<?php

namespace App\Repository;

use App\Entity\Tiket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tiket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tiket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tiket[]    findAll()
 * @method Tiket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TiketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tiket::class);
    }

    // /**
    //  * @return Tiket[] Returns an array of Tiket objects
    //  */
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
    public function findOneBySomeField($value): ?Tiket
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
