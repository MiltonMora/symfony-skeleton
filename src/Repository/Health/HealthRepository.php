<?php

namespace App\Repository\Health;

use App\Domain\Health\Model\Health;
use App\Domain\Health\Ports\HealthInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Health>
 *
 * @method Health|null find($id, $lockMode = null, $lockVersion = null)
 * @method Health|null findOneBy(array $criteria, array $orderBy = null)
 * @method Health[]    findAll()
 * @method Health[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HealthRepository extends ServiceEntityRepository implements HealthInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Health::class);
    }

    public function save(Health $health): void
    {
        $this->getEntityManager()->persist($health);
        $this->getEntityManager()->flush();
    }
}
