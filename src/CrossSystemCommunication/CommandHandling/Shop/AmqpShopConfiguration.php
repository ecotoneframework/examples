<?php


namespace Example\CrossSystemCommunication\CommandHandling\Shop;

use Ecotone\Amqp\AmqpExchange;
use Ecotone\Amqp\Configuration\RegisterAmqpPublisher;
use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;
use Ecotone\Messaging\Publisher;

/**
 * Class AmqpConfiguration
 * @package Example\Amqp\PublishReceive
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @ApplicationContext()
 */
class AmqpShopConfiguration
{
    /**
     * Registers queue and exchange publisher
     *
     * @return array
     * @Extension()
     */
    public function registerAmqpConfig(): array
    {
        return [
            RegisterAmqpPublisher::create(
                Publisher::class,
                "delivery"
            )
                ->withDefaultPersistentDelivery(true)
                ->withDefaultRoutingKey("someKey")
                ->withRoutingKeyFromHeader("routingKey")
                ->withAutoDeclareQueueOnSend(true)
                ->withHeaderMapper("system.*")
        ];
    }
}