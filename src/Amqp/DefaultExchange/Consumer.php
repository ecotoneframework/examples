<?php


namespace Example\Amqp\DefaultExchange;

use Ecotone\Amqp\Annotation\AmqpChannelAdapter;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\Poller;

/**
 * @MessageEndpoint()
 */
class Consumer
{
    const ENDPOINT_ID = "amqp_consumer";

    /**
     * @AmqpChannelAdapter(
     *     endpointId=Consumer::ENDPOINT_ID,
     *     queueName=AmqpConfiguration::AMQP_QUEUE_NAME,
     *     poller=@Poller(
     *          handledMessageLimit=1
     *     )
     * )
     */
    public function execute(string $message) : void
    {
        echo "Received Message: {$message}\n";
    }
}