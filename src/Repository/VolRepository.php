<?php

namespace App\Repository;

use App\Entity\Vol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vol|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vol|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vol[]    findAll()
 * @method Vol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VolRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vol::class);
    }

    // /**
    //  * @return Vol[] Returns an array of Vol objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findDepartMin($date, $heure, $id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "select aeroport.ville from vol join vol_voyage on vol.id_Vol = vol_voyage.id_Vol join voyage on vol_voyage.id_Voyage = voyage.id_Voyage join trajet on vol.id_Trajet = trajet.id_Trajet join aeroport on trajet.codeD = aeroport.id_Aeroport where voyage.id_Voyage = :id and vol.date_Depart = :date and vol.heure_Depart = :heure";

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('id' => $id, 'date' => $date, 'heure' => $heure));
        return $stmt->fetch();
    }

    public function findDepartMax($date, $heure, $id)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "select aeroport.ville from vol join vol_voyage on vol.id_Vol = vol_voyage.id_Vol join voyage on vol_voyage.id_Voyage = voyage.id_Voyage join trajet on vol.id_Trajet = trajet.id_Trajet join aeroport on trajet.codeA = aeroport.id_Aeroport where voyage.id_Voyage = :id and vol.date_Arrive = :date and vol.heure_Arrive = :heure";

        $stmt = $conn->prepare($sql);
        $stmt->execute(array('id' => $id, 'date' => $date, 'heure' => $heure));
        return $stmt->fetch();
    }

    /* v1
    public function findDepartMax($date, $id)
    {
        return $this->createQueryBuilder('v') 
            ->select('v')
            ->innerJoin('v.idVoyage', 'r')
            ->addSelect('r')            
            ->where('r.idVoyage = :idVoyage')
            ->andWhere('v.dateDepart = :date')
            ->setParameter('idVoyage', $id)
            ->setParameter('date', $date)
            ->getQuery()
            ->getResult();
    }
    */

    /*
    public function findOneBySomeField($value): ?Vol
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
