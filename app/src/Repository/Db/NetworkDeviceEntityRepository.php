<?php

namespace App\Repository\Db;

use App\Entity\NetworkDeviceEntity;
use App\Repository\Contract\NetworkDeviceEntityRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NetworkDeviceEntity>
 */
class NetworkDeviceEntityRepository extends ServiceEntityRepository implements NetworkDeviceEntityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NetworkDeviceEntity::class);
    }

    public function findById(int $id): ?NetworkDeviceEntity
    {
        $result = $this->find($id);

        return $result instanceof NetworkDeviceEntity ? $result : null;
    }

    public function save(NetworkDeviceEntity $networkDeviceEntity): void
    {
        $this->getEntityManager()->persist($networkDeviceEntity);
        $this->getEntityManager()->flush();
    }

    public function refresh(NetworkDeviceEntity $networkDeviceEntity): void
    {
        $this->getEntityManager()->refresh($networkDeviceEntity);
    }

//    /**
//     * @return NetworkDeviceEntity[] Returns an array of NetworkDeviceEntity objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NetworkDeviceEntity
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
