<?php


namespace Example\Async\Amqp;

use Ecotone\Amqp\AmqpBackedMessageChannelBuilder;
use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;
use Ecotone\Messaging\Conversion\MediaType;
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
    const SEND_NOTIFICATION_CHANNEL = "sendNotification";

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
            AmqpBackedMessageChannelBuilder::createDirectChannel(self::SEND_NOTIFICATION_CHANNEL)
                ->withDefaultConversionMediaType(MediaType::APPLICATION_JSON)
        ];
    }
}