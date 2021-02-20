<?php

namespace App\Repository;

use App\Entity\Facture;
use App\Entity\TriFacture;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Facture|null find($id, $lockMode = null, $lockVersion = null)
 * @method Facture|null findOneBy(array $criteria, array $orderBy = null)
 * @method Facture[]    findAll()
 * @method Facture[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FactureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Facture::class);
    }

    // /**
    //  * @return Facture[] Returns an array of Facture objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function triFacture(TriFacture $triFacture)
    {
        $query = $this->createQueryBuilder('f');
        $client = $triFacture->getClient();
        $materiel = $triFacture->getMateriel();

        // if($client){
        //     $query = $query
        //                 ->andWhere('f.client = :clientId')
        //                 ->setParameter('clientId',$client);
        // }

        // if($materiel){
        //     $query = $query
        //                 ->andWhere('f.materiel = :materielId')
        //                 ->setParameter('materielId',$materiel);
        // }

        return $query->getQuery()->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Facture
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


}
