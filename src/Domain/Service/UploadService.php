<?php

namespace App\Domain\Service;

use App\Infrastructure\Handler\PersonHandler;
use App\Infrastructure\Handler\ShipOrdersHandler;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class UploadService.
 */
class UploadService
{
    private PersonHandler $personHandler;
    private ShipOrdersHandler $shipOrdersHandler;

    /**
     * UploadService constructor.
     * @param PersonHandler $personHandler
     * @param ShipOrdersHandler $shipOrdersHandler
     */
    public function __construct(PersonHandler $personHandler, ShipOrdersHandler $shipOrdersHandler)
    {
        $this->personHandler = $personHandler;
        $this->shipOrdersHandler = $shipOrdersHandler;
    }

    /**
     * @param array $file
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function consumerXml(array $file)
    {
        /** @var UploadedFile $peopleFile */
        $peopleFile = $file['people'];
        /** @var UploadedFile $orderFile */
        $orderFile = $file['order'];

        if (!$peopleFile->isValid() || !$orderFile->isValid()) {
            throw new \DomainException('Invalid uploaded file.');
        }

        $this->personHandler->handle($peopleFile);
        $this->shipOrdersHandler->handle($orderFile);
    }
}
