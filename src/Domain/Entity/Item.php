<?php

declare(strict_types=1);

namespace App\Domain\Entity;

/**
 * Class Item.
 */
class Item
{
    private int $id;

    private string $title;

    private string $note;

    private int $quantity;

    private float $price;

    private ShipOrder $shiporder;

    /**
     * Item constructor.
     * @param string $title
     * @param string $note
     * @param int $quantity
     * @param float $price
     * @param ShipOrder $shiporder
     */
    public function __construct(string $title, string $note, int $quantity, float $price, ShipOrder $shiporder)
    {
        $this->title = $title;
        $this->note = $note;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->shiporder = $shiporder;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return ShipOrder
     */
    public function getShiporder(): ShipOrder
    {
        return $this->shiporder;
    }
}
