<?php

namespace App\Repository;

use App\Entity\MTENCREG;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MTENCREG>
 *
 * @method MTENCREG|null find($id, $lockMode = null, $lockVersion = null)
 * @method MTENCREG|null findOneBy(array $criteria, array $orderBy = null)
 * @method MTENCREG[]    findAll()
 * @method MTENCREG[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MTENCREGRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MTENCREG::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(MTENCREG $entity, bool $flush = true): void
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
    public function remove(MTENCREG $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return MTENCREG[] Returns an array of MTENCREG objects
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
    public function findOneBySomeField($value): ?MTENCREG
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
