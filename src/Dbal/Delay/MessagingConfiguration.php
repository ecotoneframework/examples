<?php


namespace Example\Dbal\Delay;

use Ecotone\Dbal\DbalBackedMessageChannelBuilder;
use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;
use Ecotone\Messaging\Conversion\MediaType;
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
    public function registerConfig(): array
    {
        return [
            DbalBackedMessageChannelBuilder::create(self::SEND_ORDER_CHANNEL)
                ->withReceiveTimeout(100)
                ->withDefaultConversionMediaType(MediaType::APPLICATION_JSON),

            PollingMetadata::create(self::SEND_ORDER_CHANNEL)
                ->setHandledMessageLimit(1)
        ];
    }
}