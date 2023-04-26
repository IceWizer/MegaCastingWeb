<?php

namespace App\Repository;

use App\Entity\BroadcastPartner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BroadcastPartner>
 *
 * @method BroadcastPartner|null find($id, $lockMode = null, $lockVersion = null)
 * @method BroadcastPartner|null findOneBy(array $criteria, array $orderBy = null)
 * @method BroadcastPartner[]    findAll()
 * @method BroadcastPartner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BroadcastPartnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BroadcastPartner::class);
    }

    public function save(BroadcastPartner $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BroadcastPartner $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BroadcastPartner[] Returns an array of BroadcastPartner objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BroadcastPartner
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
