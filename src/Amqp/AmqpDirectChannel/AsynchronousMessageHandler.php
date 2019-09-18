<?php


namespace Example\Amqp\AmqpDirectChannel;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\CommandHandler;

/**
 * Class CommandConsumer
 * @package Example\Amqp\PublishReceive
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class AsynchronousMessageHandler
{
    const ENDPOINT_ID = "receiveMessagesEndpoint";

    /**
     * @CommandHandler(
     *     endpointId=AsynchronousMessageHandler::ENDPOINT_ID,
     *     inputChannelName=AmqpConfiguration::AMQP_CHANNEL_NAME
     * )
     * @param string $command
     */
    public function execute(string $command) : void
    {
        echo "Received Message: {$command}\n";
        die("Example passed\n");
    }
}