<?php

namespace App\Infrastructure\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class FileUploadConsumer.
 */
class FileUploadConsumer implements ConsumerInterface
{
    /**
     * @param AMQPMessage $msg
     * @return mixed|void
     */
    public function execute(AMQPMessage $msg)
    {
        // TODO: Implement execute() method.
    }
}
