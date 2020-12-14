<?php

namespace App\Infrastructure\Handler;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Interface XmlHandlerInterface.
 */
interface XmlHandlerInterface
{
    public function handle(UploadedFile $file);
}
