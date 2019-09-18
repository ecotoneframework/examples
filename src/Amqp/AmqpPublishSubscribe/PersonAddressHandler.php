<?php


namespace Example\Amqp\AmqpPublishSubscribe;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\Poller;
use Ecotone\Modelling\Annotation\CommandHandler;

/**
 * Class CommandConsumer
 * @package Example\Amqp\PublishReceive
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class PersonAddressHandler
{
    const ENDPOINT_ID = "personAddress";

    /**
     * Poller is used to finish handling after first message
     *
     * @CommandHandler(
     *     endpointId=PersonAddressHandler::ENDPOINT_ID,
     *     inputChannelName=AmqpConfiguration::PERSON_REGISTER_CHANNEL,
     *     mustBeUnique=false,
     *
     *     poller=@Poller(
     *          handledMessageLimit=1
     *     )
     * )
     * @param RegisterPersonAddress $command
     */
    public function execute(RegisterPersonAddress $command): void
    {
        echo "Person address registered:\n";
        var_dump($command);
    }
}