<?php


namespace Example\Async\Amqp;

use Ecotone\Messaging\Annotation\Async;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\ServiceActivator;
use Ecotone\Modelling\Annotation\EventHandler;
use Example\Async\Amqp\AmqpConfiguration;

/**
 * Class SendNotificationWhenPersonRegistered
 * @package Example\Async\Amqp
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class SendNotificationWhenPersonRegistered
{
    /**
     * @param PersonRelatedEvent $personWasRegistered
     *
     * @EventHandler(endpointId="notificator")
     * @Async(channelName=AmqpConfiguration::SEND_NOTIFICATION_CHANNEL)
     */
    public function send(PersonRelatedEvent $personWasRegistered)
    {
        echo "Received event";
        var_dump($personWasRegistered);

        die();
    }
}