<?php

namespace App\Repository;

use App\Entity\AttendenceConfiguration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttendenceConfiguration|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttendenceConfiguration|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttendenceConfiguration[]    findAll()
 * @method AttendenceConfiguration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttendenceConfigurationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttendenceConfiguration::class);
    }

    // /**
    //  * @return AttendenceConfiguration[] Returns an array of AttendenceConfiguration objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AttendenceConfiguration
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
