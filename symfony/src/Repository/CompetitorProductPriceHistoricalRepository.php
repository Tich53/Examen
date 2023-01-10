<?php

namespace App\Repository;

use App\Entity\CompetitorProductPriceHistorical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompetitorProductPriceHistorical>
 *
 * @method CompetitorProductPriceHistorical|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetitorProductPriceHistorical|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetitorProductPriceHistorical[]    findAll()
 * @method CompetitorProductPriceHistorical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetitorProductPriceHistoricalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompetitorProductPriceHistorical::class);
    }

    public function add(CompetitorProductPriceHistorical $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompetitorProductPriceHistorical $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CompetitorProductPriceHistorical[] Returns an array of CompetitorProductPriceHistorical objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CompetitorProductPriceHistorical
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
