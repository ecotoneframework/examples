<?php


namespace Example\Amqp\Async;

use Ecotone\Amqp\AmqpBackedMessageChannelBuilder;
use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Endpoint\PollingMetadata;
use Ecotone\Messaging\MessagingException;
use Ecotone\Messaging\Support\InvalidArgumentException;

/**
 * @ApplicationContext()
 */
class AmqpConfiguration
{
    const SEND_NOTIFICATION_CHANNEL = "amqp_sendNotification";

    /**
     * Registers queue and exchange publisher
     *
     * @Extension()
     */
    public function registerAmqpConfig(): array
    {
        return [
            AmqpBackedMessageChannelBuilder::create(self::SEND_NOTIFICATION_CHANNEL)
                ->withDefaultConversionMediaType(MediaType::APPLICATION_JSON),

            PollingMetadata::create(self::SEND_NOTIFICATION_CHANNEL)
                ->setHandledMessageLimit(1)
        ];
    }
}