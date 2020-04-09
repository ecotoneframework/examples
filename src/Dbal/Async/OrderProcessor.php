<?php


namespace Example\Dbal\Async;

use Ecotone\Messaging\Annotation\Async;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\ServiceActivator;
use Ecotone\Modelling\Annotation\CommandHandler;
use Ecotone\Modelling\Annotation\EventHandler;
use Example\Dbal\Async\DbalConfiguration;

/**
 * @MessageEndpoint()
 */
class OrderProcessor
{
    /**
     * @CommandHandler(endpointId="order_processor")
     * @Async(channelName=DbalConfiguration::SEND_ORDER_CHANNEL)
     */
    public function send(PlaceOrder $command)
    {
        echo "Received event";
        var_dump($command);
    }
}