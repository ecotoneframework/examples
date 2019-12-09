<?php


namespace Example\CrossSystemCommunication\EventHandling\Notification;

use Ecotone\Amqp\Annotation\AmqpChannelAdapter;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\Poller;
use Ecotone\Modelling\CommandBus;

/**
 * @MessageEndpoint()
 */
class Notificator
{
    /**
     * @AmqpChannelAdapter(
     *     endpointId="notificator",
     *     queueName=AmqpNotificationConfiguration::NOTIFICATION_QUEUE,
     *     poller=@Poller(executionTimeLimitInMilliseconds=100)
     * )
     */
    public function receive(string $event) : void
    {
        echo "Notification received {$event}\n";
    }
}