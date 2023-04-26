<?php

namespace App\Repository;

use App\Entity\EmergencyLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmergencyLevel>
 *
 * @method EmergencyLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmergencyLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmergencyLevel[]    findAll()
 * @method EmergencyLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmergencyLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmergencyLevel::class);
    }

    public function save(EmergencyLevel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EmergencyLevel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EmergencyLevel[] Returns an array of EmergencyLevel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EmergencyLevel
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
