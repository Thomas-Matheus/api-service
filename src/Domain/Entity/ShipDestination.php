<?php

namespace App\Domain\Entity;

/**
 * Class ShipDestination.
 */
class ShipDestination
{
    private int $id;

    private string $name;

    private string $address;

    private string $city;

    private string $country;

    /**
     * ShipDestination constructor.
     * @param string $name
     * @param string $address
     * @param string $city
     * @param string $country
     */
    public function __construct(string $name, string $address, string $city, string $country)
    {
        $this->name = $name;
        $this->address = $address;
        $this->city = $city;
        $this->country = $country;
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
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}
