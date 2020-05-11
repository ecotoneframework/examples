<?php


namespace Example\Amqp\Delay;

use Ecotone\Messaging\Annotation\Asynchronous;
use Ecotone\Messaging\Annotation\Endpoint\Delayed;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\CommandHandler;

/**
 * @MessageEndpoint()
 */
class OrderProcessor
{
    /**
     * @Delayed(10000)
     * @Asynchronous(channelName=MessagingConfiguration::SEND_ORDER_CHANNEL)
     * @CommandHandler(inputChannelName="placeOrder", endpointId="order_processor")
     */
    public function placeOrder(string $order)
    {
        echo "Received order {$order}\n";
    }
}