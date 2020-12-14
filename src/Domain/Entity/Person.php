<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Person.
 */
class Person
{
    private int $id;

    private string $name;
    /**
     * @var Collection
     * @Serializer\SerializedName("phone_person")
     */
    private Collection $phones;

    /**
     * Person constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->phones = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Collection
     */
    public function getPhones(): Collection
    {
        return $this->phones;
    }

    /**
     * @param Phone $phone
     * @return $this
     */
    public function addPhones(Phone $phone)
    {
        $this->phones->add($phone);

        return $this;
    }
}
