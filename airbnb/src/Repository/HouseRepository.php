<?php

namespace App\Repository;

use App\Entity\House;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method House|null find($id, $lockMode = null, $lockVersion = null)
 * @method House|null findOneBy(array $criteria, array $orderBy = null)
 * @method House[]    findAll()
 * @method House[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, House::class);
    }

    /**
     * @return House[] Returns an array of House objects
     */
    public function findByCity($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.city = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    

    public function filterSearch($filters = [], $limit = -1, $offset = -1)
    {
        $qb = $this->createQueryBuilder('h');
        $parameters = [];

        if (isset($filters['city']) && !empty($filters['city'])) {
            $qb->andWhere('h.city = :city');
            $parameters['city'] = $filters['city'];
        }
        if (isset($filters['type']) && !empty($filters['type'])) {
            $qb->andWhere('h.type = :type');
            $parameters['type'] = $filters['type'];
        }
        if (isset($filters['price']) && !empty($filters['price'])) {
            $qb->andWhere('h.price = :price');
            $parameters['price'] = $filters['price'];
        }
        if (isset($filters['bedNumber']) && !empty($filters['bedNumber'])) {
            $qb->andWhere('h.bedNumber = :bedNumber');
            $parameters['bedNumber'] = $filters['bedNumber'];
        }

        if ($offset > -1)
            $qb->setFirstResult( $offset );
        if ($limit > -1)
           $qb->setMaxResults( $limit );

        $qb->setParameters($parameters);
        return $qb->getQuery()->getResult();
    }

    /*
    public function findOneBySomeField($value): ?House
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
