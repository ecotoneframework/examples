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
class RegisterPersonProfileHandler
{
    const ENDPOINT_ID = "registerPersonProfile";

    /**
     * Poller is used to finish handling after first message
     *
     * @CommandHandler(
     *     endpointId=RegisterPersonProfileHandler::ENDPOINT_ID,
     *     inputChannelName=AmqpConfiguration::PERSON_REGISTER_CHANNEL,
     *     mustBeUnique=false,
     *
     *     poller=@Poller(
     *          handledMessageLimit=1
     *     )
     * )
     * @param RegisterPersonProfile $command
     */
    public function execute(RegisterPersonProfile $command): void
    {
        echo "Person profile registered\n";
        var_dump($command);
    }
}