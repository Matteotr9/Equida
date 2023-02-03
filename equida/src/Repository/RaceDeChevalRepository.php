<?php

namespace App\Repository;

use App\Entity\RaceDeCheval;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RaceDeCheval>
 *
 * @method RaceDeCheval|null find($id, $lockMode = null, $lockVersion = null)
 * @method RaceDeCheval|null findOneBy(array $criteria, array $orderBy = null)
 * @method RaceDeCheval[]    findAll()
 * @method RaceDeCheval[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaceDeChevalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RaceDeCheval::class);
    }

    public function save(RaceDeCheval $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RaceDeCheval $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RaceDeCheval[] Returns an array of RaceDeCheval objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RaceDeCheval
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
