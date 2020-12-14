<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Person;
use App\Domain\Repository\PersonRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class PersonRepository.
 */
class PersonRepository implements PersonRepositoryInterface
{
    public EntityManagerInterface $entityManager;

    /**
     * PersonRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $id
     * @return Person|mixed|object|null
     */
    public function findById(int $id)
    {
        return $this->entityManager->getRepository(Person::class)->find($id);
    }

    /**
     * @param array $criteria
     * @return Person[]|array|mixed|object[]
     */
    public function findByCriteria(array $criteria)
    {
        return $this->entityManager->getRepository(Person::class)->findBy($criteria);
    }
}
