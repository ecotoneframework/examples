<?php


namespace Example\Amqp\Expiration;

use Ecotone\Messaging\Annotation\Asynchronous;
use Ecotone\Messaging\Annotation\Endpoint\ExpireAfter;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\CommandHandler;

/**
 * @MessageEndpoint()
 */
class OrderProcessor
{
    /**
     * @Asynchronous(channelName=MessagingConfiguration::SEND_ORDER_CHANNEL)
     * @CommandHandler(inputChannelName="placeOrder", endpointId="order_processor")
     * @ExpireAfter(10000)
     */
    public function placeOrder(string $order)
    {
        echo "Received order {$order}\n";
    }
}