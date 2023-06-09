<?php

namespace App\Repository;

use App\Entity\CastingOffer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

/**
 * @extends ServiceEntityRepository<CastingOffer>
 *
 * @method CastingOffer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CastingOffer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CastingOffer[]    findAll()
 * @method CastingOffer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CastingOfferRepository extends ServiceEntityRepository
{


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CastingOffer::class);
    }

    public function save(CastingOffer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CastingOffer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CastingOffer[] Returns an array of CastingOffer objects
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

//    public function findOneBySomeField($value): ?CastingOffer
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function isPostuler(CastingOffer $data, #[CurrentUser] $user): bool
    {
        return $this->createQueryBuilder('c')
            ->innerJoin('c.users', 'u', Join::ON, 'u.id = :user')
            ->select('COUNT(c.id)')
            ->getQuery()
            ->setParameter('user', $user->getId())
            ->getSingleScalarResult() > 0;
    }
}
