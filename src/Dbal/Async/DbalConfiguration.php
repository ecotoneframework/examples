<?php


namespace Example\Dbal\Async;

use Ecotone\Dbal\DbalBackedMessageChannelBuilder;
use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Endpoint\PollingMetadata;
use Ecotone\Messaging\MessagingException;
use Ecotone\Messaging\Support\InvalidArgumentException;

/**
 * @ApplicationContext()
 */
class DbalConfiguration
{
    const SEND_ORDER_CHANNEL = "dbal_place_order";

    /**
     * Registers queue and exchange publisher
     *
     * @Extension()
     */
    public function registerDbalConfig(): array
    {
        return [
            DbalBackedMessageChannelBuilder::create(self::SEND_ORDER_CHANNEL)
                ->withDefaultConversionMediaType(MediaType::APPLICATION_JSON),

            PollingMetadata::create(self::SEND_ORDER_CHANNEL)
                ->setHandledMessageLimit(1)
        ];
    }
}