<?php


namespace Example\Amqp\AmqpDirectChannel;

use Ecotone\Amqp\AmqpBackedMessageChannelBuilder;
use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;
use Ecotone\Messaging\MessagingException;
use Ecotone\Messaging\Support\InvalidArgumentException;

/**
 * Class AmqpConfiguration
 * @package Example\Amqp\PublishReceive
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @ApplicationContext()
 */
class AmqpConfiguration
{
    const AMQP_CHANNEL_NAME = "inputChannel";

    /**
     * Registers queue and exchange publisher
     *
     * @return array
     * @throws MessagingException
     * @throws InvalidArgumentException
     * @Extension()
     */
    public function registerAmqpConfig(): array
    {
        return [
            AmqpBackedMessageChannelBuilder::createDirectChannel(self::AMQP_CHANNEL_NAME)
        ];
    }
}