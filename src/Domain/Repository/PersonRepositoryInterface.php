<?php

namespace App\Domain\Repository;

/**
 * Interface PersonRepositoryInterface.
 */
interface PersonRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * @param array $criteria
     * @return mixed
     */
    public function findByCriteria(array $criteria);
}
