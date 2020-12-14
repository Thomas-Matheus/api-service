<?php

namespace App\Infrastructure\Handler;

use App\Domain\Entity\Item;
use App\Domain\Entity\Person;
use App\Domain\Entity\ShipDestination;
use App\Domain\Entity\ShipOrder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ShipOrdersHandler.
 */
class ShipOrdersHandler implements XmlHandlerInterface
{
    private EntityManagerInterface $entityManager;

    /**
     * ShipOrdersHandler constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(UploadedFile $file)
    {
        $xmlLoaded = json_decode(json_encode(simplexml_load_file($file->getRealPath())));

        if (empty($xmlLoaded->shiporder)) {
            return;
        }

        foreach ($xmlLoaded->shiporder as $shipOrder) {
            $entityPerson = $this->entityManager
                ->getRepository(Person::class)
                ->find(filter_var($shipOrder->orderperson, FILTER_VALIDATE_INT));

            if (!$entityPerson) {
                $entityPerson = new Person((int) $shipOrder->orderperson, '');
            }

            $shipDestination = new ShipDestination(
                (string) $shipOrder->shipto->name,
                (string) $shipOrder->shipto->address,
                (string) $shipOrder->shipto->city,
                (string) $shipOrder->shipto->country
            );

            $shipOrderEntity = new ShipOrder(
                (int) $shipOrder->orderid,
                $entityPerson,
                $shipDestination
            );

            if (!empty($shipOrder->items->item)) {
                foreach ($shipOrder->items as $item) {
                    $itemEntity = new Item(
                        $item->title,
                        $item->note,
                        (int) $item->quantity,
                        (float) $item->price,
                        $shipOrderEntity
                    );
                    $shipOrderEntity->addItem($itemEntity);
                }
            }

            $this->entityManager->persist($shipOrderEntity);
        }

        $this->entityManager->flush();
    }
}
