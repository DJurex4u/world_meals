<?php

namespace App\Repository;

use App\Entity\IngredientTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method IngredientTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method IngredientTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method IngredientTranslation[]    findAll()
 * @method IngredientTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IngredientTranslation::class);
    }

    // /**
    //  * @return IngredientTranslation[] Returns an array of IngredientTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IngredientTranslation
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
