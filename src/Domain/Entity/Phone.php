<?php

declare(strict_types=1);

namespace App\Domain\Entity;

/**
 * Class Phone.
 */
class Phone
{
    private int $id;

    private string $phone;

    private Person $person;

    /**
     * Phone constructor.
     * @param string $phone
     */
    public function __construct(string $phone)
    {
        $this->phone = $phone;
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
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }
}
