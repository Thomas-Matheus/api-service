<?php

namespace App\Domain\Service;

use App\Domain\Entity\ShipOrder;
use App\Infrastructure\Persistence\ShipOrderRepository;

/**
 * Class ShipOrderService.
 */
class ShipOrderService
{
    private ShipOrderRepository $shipOrderRepository;

    /**
     * ShipOrderService constructor.
     * @param ShipOrderRepository $shipOrderRepository
     */
    public function __construct(ShipOrderRepository $shipOrderRepository)
    {
        $this->shipOrderRepository = $shipOrderRepository;
    }

    /**
     * @param array $criteria
     * @return ShipOrder[]|array|mixed
     */
    public function findBy(array $criteria)
    {
        return $this->shipOrderRepository->findByCriteria($criteria);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->shipOrderRepository->findById($id);
    }
}
