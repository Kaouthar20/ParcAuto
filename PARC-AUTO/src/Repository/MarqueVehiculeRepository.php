<?php

namespace App\Repository;

use App\Entity\MarqueVehicule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MarqueVehicule>
 *
 * @method MarqueVehicule|null find($id, $lockMode = null, $lockVersion = null)
 * @method MarqueVehicule|null findOneBy(array $criteria, array $orderBy = null)
 * @method MarqueVehicule[]    findAll()
 * @method MarqueVehicule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarqueVehiculeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MarqueVehicule::class);
    }

    public function add(MarqueVehicule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(MarqueVehicule $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return MarqueVehicule[] Returns an array of MarqueVehicule objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?MarqueVehicule
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
