<?php


namespace Example\Amqp\Async;

use Ecotone\Messaging\Annotation\Asynchronous;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\EventHandler;

/**
 * @MessageEndpoint()
 */
class SendNotificationWhenPersonRegistered
{
    /**
     * @Asynchronous(channelName=AmqpConfiguration::SEND_NOTIFICATION_CHANNEL)
     * @EventHandler(endpointId="notificator")
     */
    public function send(PersonRelatedEvent $personWasRegistered)
    {
        echo "Received event";
        var_dump($personWasRegistered);
    }
}