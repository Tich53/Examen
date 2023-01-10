<?php

namespace App\Repository;

use App\Entity\ScrapingHistorical;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ScrapingHistorical>
 *
 * @method ScrapingHistorical|null find($id, $lockMode = null, $lockVersion = null)
 * @method ScrapingHistorical|null findOneBy(array $criteria, array $orderBy = null)
 * @method ScrapingHistorical[]    findAll()
 * @method ScrapingHistorical[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScrapingHistoricalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ScrapingHistorical::class);
    }

    public function save(ScrapingHistorical $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ScrapingHistorical $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ScrapingHistorical[] Returns an array of ScrapingHistorical objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ScrapingHistorical
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
