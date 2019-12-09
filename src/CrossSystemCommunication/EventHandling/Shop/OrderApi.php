<?php


namespace Example\CrossSystemCommunication\EventHandling\Shop;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Publisher;
use Ecotone\Modelling\Annotation\CommandHandler;
use Example\CrossSystemCommunication\CommandHandling\Delivery\AmqpDeliveryConfiguration;

/**
 * @MessageEndpoint()
 */
class OrderApi
{
    /**
     * @CommandHandler(inputChannelName="order.accept")
     */
    public function acceptOrder(string $order, Publisher $eventPublisher) : void
    {
        $eventPublisher->send("orderFinished");
    }
}