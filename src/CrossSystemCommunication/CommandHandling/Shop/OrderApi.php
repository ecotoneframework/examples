<?php


namespace Example\CrossSystemCommunication\CommandHandling\Shop;

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
    public function acceptOrder(string $order, Publisher $deliveryPublisher) : void
    {
        $deliveryPublisher->sendWithMetadata(
            $order,
            [
                "amqpRouting" => AmqpDeliveryConfiguration::ORDER_PROCESSOR_ROUTING_KEY,
                "system.executor" => "Johny"
            ]
        );
    }
}