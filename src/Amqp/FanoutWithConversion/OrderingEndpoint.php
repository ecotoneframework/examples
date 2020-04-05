<?php


namespace Example\Amqp\FanoutWithConversion;

use Ecotone\Amqp\Annotation\AmqpChannelAdapter;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\Poller;

/**
 * @MessageEndpoint()
 */
class OrderingEndpoint
{
    const ENDPOINT_ID = "orderingEndpoint";

    /**
     * @AmqpChannelAdapter(
     *     endpointId=OrderingEndpoint::ENDPOINT_ID,
     *     queueName=AmqpConfiguration::ORDERS_QUEUE,
     *     poller=@Poller(
     *          handledMessageLimit=1
     *     )
     * )
     */
    public function execute(Order $order) : void
    {
        echo "Received Order object\n";
    }
}