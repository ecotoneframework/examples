<?php


namespace Example\Amqp\DefaultExchange;

use Ecotone\Amqp\AmqpBackedMessageChannelBuilder;
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
    const AMQP_QUEUE_NAME = "amqp_default_queue";

    /**
     * @Extension()
     */
    public function registerDefaultExchangePublisher()
    {
//        in default exchange routing, Rabbitmq make use of Direct Exchange, the consumer routing key is the queue name
        return RegisterAmqpPublisher::create(Publisher::class)
                    ->withDefaultRoutingKey(self::AMQP_QUEUE_NAME)
                    ->withAutoDeclareQueueOnSend(true);
    }

    /**
     * @Extension()
     */
    public function registerAmqpConfig()
    {
        return AmqpQueue::createWith(self::AMQP_QUEUE_NAME);
    }
}