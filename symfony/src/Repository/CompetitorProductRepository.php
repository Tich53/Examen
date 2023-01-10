<?php

namespace App\Repository;

use App\Entity\CompetitorProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CompetitorProduct>
 *
 * @method CompetitorProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompetitorProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompetitorProduct[]    findAll()
 * @method CompetitorProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetitorProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompetitorProduct::class);
    }

    public function add(CompetitorProduct $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CompetitorProduct $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByCleanedBrandAndReference(string $cleanedBrand, string $cleanedReference): ?CompetitorProduct
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.cleaned_brand = :cleaned_brand')
            ->andWhere('c.cleaned_reference = :cleaned_reference')
            ->setParameters([
                'cleaned_brand'=> $cleanedBrand,
                'cleaned_reference'=> $cleanedReference,
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByUrl(string $url): ?CompetitorProduct
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.url = :url')
            ->setParameters([
                'url'=> $url,
            ])
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return CompetitorProduct[] Returns an array of CompetitorProduct objects
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

//    public function findOneBySomeField($value): ?CompetitorProduct
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
