<?php

namespace App\Repository;

use App\Entity\GestionCliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GestionCliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method GestionCliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method GestionCliente[]    findAll()
 * @method GestionCliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GestionClienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GestionCliente::class);
    }

    // /**
    //  * @return GestionCliente[] Returns an array of GestionCliente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GestionCliente
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
