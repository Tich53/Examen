<?php

namespace App\Repository;

use App\Entity\Competitor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Competitor>
 *
 * @method Competitor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Competitor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Competitor[]    findAll()
 * @method Competitor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompetitorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Competitor::class);
    }

    public function add(Competitor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Competitor $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findOneByName(string $name): ?Competitor
   {
       return $this->createQueryBuilder('c')
           ->andWhere('c.name = :name')
           ->setParameter('name', $name)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
//    /**
//     * @return Competitor[] Returns an array of Competitor objects
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

//    public function findOneBySomeField($value): ?Competitor
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
