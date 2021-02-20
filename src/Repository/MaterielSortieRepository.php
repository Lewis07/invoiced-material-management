<?php

namespace App\Repository;

use App\Entity\MaterielSortie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MaterielSortie|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaterielSortie|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaterielSortie[]    findAll()
 * @method MaterielSortie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterielSortieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MaterielSortie::class);
    }

    // /**
    //  * @return MaterielSortie[] Returns an array of MaterielSortie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MaterielSortie
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
