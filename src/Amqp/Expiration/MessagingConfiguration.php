<?php


namespace Example\Amqp\Expiration;

use Ecotone\Amqp\AmqpBackedMessageChannelBuilder;
use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;
use Ecotone\Messaging\Endpoint\PollingMetadata;

/**
 * @ApplicationContext()
 */
class MessagingConfiguration
{
    const SEND_ORDER_CHANNEL = "dbal_place_order";

    /**
     * @Extension()
     */
    public function registerMessagingConfig(): array
    {
        return [
            AmqpBackedMessageChannelBuilder::create(self::SEND_ORDER_CHANNEL)
                ->withReceiveTimeout(100),

            PollingMetadata::create(self::SEND_ORDER_CHANNEL)
                ->setHandledMessageLimit(1)
        ];
    }
}