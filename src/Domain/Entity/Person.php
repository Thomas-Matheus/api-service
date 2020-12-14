<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class Person.
 */
class Person
{
    private int $id;

    private string $name;
    /**
     * @var ArrayCollection
     * @Serializer\SerializedName("phone_person")
     */
    private ArrayCollection $phones;

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
     * @return ArrayCollection
     */
    public function getPhones(): ArrayCollection
    {
        return $this->phones;
    }

    /**
     * @param Phone $phone
     */
    public function addPhones(Phone $phone)
    {
        $this->phones->add($phone);
    }
}
