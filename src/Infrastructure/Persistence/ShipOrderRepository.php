<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\ShipOrder;
use App\Domain\Repository\ShipOrderRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class ShipOrderRepository.
 */
class ShipOrderRepository implements ShipOrderRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    /**
     * ShipOrderRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->entityManager->getRepository(ShipOrder::class)->find($id);
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function findByCriteria(array $criteria)
    {
        return $this->entityManager->getRepository(ShipOrder::class)->findBy($criteria);
    }
}
