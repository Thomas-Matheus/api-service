<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class ShipOrder.
 */
class ShipOrder
{
    private int $id;

    private Person $orderPerson;

    private ShipDestination $shipDestination;
    /**
     * @var Collection
     * @Serializer\SerializedName("item_shipord")
     */
    private Collection $itens;

    /**
     * ShipOrder constructor.
     * @param int $id
     * @param Person $person
     * @param ShipDestination $shipDestination
     */
    public function __construct(int $id, Person $person, ShipDestination $shipDestination)
    {
        $this->id = $id;
        $this->orderPerson = $person;
        $this->shipDestination = $shipDestination;
        $this->itens = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Person
     */
    public function getOrderPerson(): Person
    {
        return $this->orderPerson;
    }

    /**
     * @return ShipDestination
     */
    public function getShipDestination(): ShipDestination
    {
        return $this->shipDestination;
    }

    /**
     * @return Collection
     */
    public function getItens(): Collection
    {
        return $this->itens;
    }

    /**
     * @param Item $item
     */
    public function addItem(Item $item)
    {
        $this->itens->add($item);

        return $this;
    }
}
