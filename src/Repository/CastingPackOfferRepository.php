<?php

namespace App\Repository;

use App\Entity\CastingPackOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CastingPackOffer>
 *
 * @method CastingPackOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CastingPackOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CastingPackOffer[]    findAll()
 * @method CastingPackOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CastingPackOfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CastingPackOffer::class);
    }

    public function save(CastingPackOffer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CastingPackOffer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CastingPackOffer[] Returns an array of CastingPackOffer objects
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

//    public function findOneBySomeField($value): ?CastingPackOffer
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
