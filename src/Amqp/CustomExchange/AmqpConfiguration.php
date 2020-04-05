<?php

namespace Example\Amqp\CustomExchange;

use Ecotone\Amqp\AmqpBackedMessageChannelBuilder;
use Ecotone\Amqp\AmqpBinding;
use Ecotone\Amqp\AmqpExchange;
use Ecotone\Amqp\AmqpQueue;
use Ecotone\Amqp\Configuration\RegisterAmqpPublisher;
use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;
use Ecotone\Messaging\MessagingException;
use Ecotone\Messaging\Publisher;
use Ecotone\Messaging\Support\InvalidArgumentException;

/**
 * @ApplicationContext()
 */
class AmqpConfiguration
{
    const EXCHANGE_NAME = "custom";

    const AMQP_QUEUE_NAME = "amqp_custom_queue";

    const ROUTING_KEY = "customQueue";

    /**
     * @Extension()
     */
    public function registerDefaultExchangePublisher()
    {
        return RegisterAmqpPublisher::create(Publisher::class, self::EXCHANGE_NAME)
                    ->withDefaultRoutingKey(self::ROUTING_KEY)
                    ->withAutoDeclareQueueOnSend(true);
    }

    /**
     * @Extension()
     */
    public function registerAmqpConfig()
    {
        $amqpExchange = AmqpExchange::createDirectExchange(self::EXCHANGE_NAME);
        $amqpQueue = AmqpQueue::createWith(self::AMQP_QUEUE_NAME);

        return [
            $amqpExchange,
            $amqpQueue,
            AmqpBinding::createWith($amqpExchange, $amqpQueue, self::ROUTING_KEY)
        ];
    }
}