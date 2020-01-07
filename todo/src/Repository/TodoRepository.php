<?php

namespace App\Repository;

use App\Entity\Todo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Todo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Todo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Todo[]    findAll()
 * @method Todo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TodoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Todo::class);
    }

    public function checkAll()
    {
        $qb = $this->createQueryBuilder('t');
        $q = $qb->update('App\Entity\Todo', 't')
            ->set('t.isDone', 1)
            ->getQuery()
            ->execute();
    }

    public function uncheckAll()
    {
        $qb = $this->createQueryBuilder('t');
        $q = $qb->update('App\Entity\Todo', 't')
        ->set('t.isDone', 0)
        ->getQuery()
        ->execute();
    }
}
