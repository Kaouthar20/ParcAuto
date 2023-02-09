<?php

namespace App\Repository;

use App\Entity\ArticleExpire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ArticleExpire|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleExpire|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleExpire[]    findAll()
 * @method ArticleExpire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleExpireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleExpire::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(ArticleExpire $entity, bool $flush = true): void
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
    public function remove(ArticleExpire $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return ArticleExpire[] Returns an array of ArticleExpire objects
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
    public function findOneBySomeField($value): ?ArticleExpire
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
