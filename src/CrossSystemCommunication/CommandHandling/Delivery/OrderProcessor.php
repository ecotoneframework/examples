<?php


namespace Example\CrossSystemCommunication\CommandHandling\Delivery;

use Ecotone\Amqp\Annotation\AmqpChannelAdapter;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\Poller;
use Ecotone\Modelling\CommandBus;

/**
 * @MessageEndpoint()
 */
class OrderProcessor
{
    /**
     * @AmqpChannelAdapter(
     *     endpointId="orderProcessor",
     *     queueName=AmqpDeliveryConfiguration::ORDER_PROCESS_QUEUE,
     *     headerMapper="system.*",
     *     poller=@Poller(executionTimeLimitInMilliseconds=100)
     * )
     */
    public function receive(string $order, array $metadata, CommandBus $commandBus) : void
    {
        echo "Delivery system received {$order} executed by {$metadata['system.executor']}\n";

//        In here you can for example inject and call CommandBus
//        $commandBus->convertAndSend("order.deliver", $metadata["contentType"], $order);
    }
}