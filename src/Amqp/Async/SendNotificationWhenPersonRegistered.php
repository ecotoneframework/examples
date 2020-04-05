<?php


namespace Example\Amqp\Async;

use Ecotone\Messaging\Annotation\Async;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\ServiceActivator;
use Ecotone\Modelling\Annotation\EventHandler;
use Example\Amqp\Async\AmqpConfiguration;

/**
 * @MessageEndpoint()
 */
class SendNotificationWhenPersonRegistered
{
    /**
     * @EventHandler(endpointId="notificator")
     * @Async(channelName=AmqpConfiguration::SEND_NOTIFICATION_CHANNEL)
     */
    public function send(PersonRelatedEvent $personWasRegistered)
    {
        echo "Received event";
        var_dump($personWasRegistered);
    }
}