<?php

namespace App\Repository;

use App\Entity\CorrespAnalyse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CorrespAnalyse>
 *
 * @method CorrespAnalyse|null find($id, $lockMode = null, $lockVersion = null)
 * @method CorrespAnalyse|null findOneBy(array $criteria, array $orderBy = null)
 * @method CorrespAnalyse[]    findAll()
 * @method CorrespAnalyse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CorrespAnalyseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CorrespAnalyse::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(CorrespAnalyse $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(CorrespAnalyse $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return CorrespAnalyse[] Returns an array of CorrespAnalyse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CorrespAnalyse
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
