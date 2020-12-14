<?php

namespace App\Domain\Service;

use App\Domain\Entity\Person;
use App\Domain\Entity\Phone;
use App\Infrastructure\Persistence\PersonRepository;

/**
 * Class PersonService.
 */
class PersonService
{
    private PersonRepository $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * @param array $criteria
     * @return Person[]|array|mixed|object[]
     */
    public function findBy(array $criteria)
    {
        return $this->personRepository->findByCriteria($criteria);
    }

    /**
     * @param int $id
     * @return Person|mixed|object|null
     */
    public function findById(int $id)
    {
        return $this->personRepository->findById($id);
    }

    /**
     * @param $personXml
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function savePerson($personXml)
    {
        foreach ($personXml->person as $person) {
            $personEntity = new Person($person->personid, $person->personname);

            if (!empty($person->phones->phone)) {
                $phones = is_array($person->phones->phone)
                    ? $person->phones->phone
                    : [$person->phones->phone];

                foreach ($phones as $phone) {
                    $phoneEntity = new Phone($phone);
                    $personEntity->addPhones($phoneEntity);
                }
            }

            $this->personRepository->entityManager->persist($personEntity);
        }

        $this->personRepository->entityManager->flush();
    }
}
