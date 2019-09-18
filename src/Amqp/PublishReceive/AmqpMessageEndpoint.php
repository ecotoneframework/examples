<?php


namespace Example\Amqp\PublishReceive;

use Ecotone\Amqp\Annotation\AmqpChannelAdapter;
use Ecotone\Messaging\Annotation\MessageEndpoint;

/**
 * Class CommandConsumer
 * @package Example\Amqp\PublishReceive
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class AmqpMessageEndpoint
{
    const ENDPOINT_ID = "receiveMessagesEndpoint";

    /**
     * @AmqpChannelAdapter(
     *     endpointId=AmqpMessageEndpoint::ENDPOINT_ID,
     *     queueName="messages"
     * )
     * @param string $command
     */
    public function execute(string $command) : void
    {
        echo "Received Message: {$command}\n";
        die("Example passed\n");
    }
}