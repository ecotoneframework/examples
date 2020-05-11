<?php


namespace Example\Dbal\Async;

use Ecotone\Messaging\Annotation\Asynchronous;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\CommandHandler;

/**
 * @MessageEndpoint()
 */
class OrderProcessor
{
    /**
     * @Asynchronous(channelName=DbalConfiguration::SEND_ORDER_CHANNEL)
     * @CommandHandler(endpointId="order_processor")
     */
    public function send(PlaceOrder $command)
    {
        echo "Received event";
        var_dump($command);
    }
}