<?php

namespace App\Infrastructure\Handler;

use App\Domain\Service\PersonService;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class PersonHandler.
 */
class PersonHandler implements XmlHandlerInterface
{
    private PersonService $personService;

    /**
     * PeopleXmlHandler constructor.
     * @param PersonService $personService
     */
    public function __construct(PersonService $personService)
    {
        $this->personService = $personService;
    }

    /**
     * @param UploadedFile $file
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function handle(UploadedFile $file)
    {
        $xmlLoaded = json_decode(json_encode(simplexml_load_file($file->getRealPath())));

        $this->personService->savePerson($xmlLoaded);
    }
}
