<?php


namespace Example\Amqp\FanoutWithConversion;

use Ecotone\Amqp\AmqpBinding;
use Ecotone\Amqp\AmqpExchange;
use Ecotone\Amqp\AmqpQueue;
use Ecotone\Amqp\Configuration\RegisterAmqpPublisher;
use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Publisher;
use Enqueue\AmqpLib\AmqpConnectionFactory;

/**
 * @ApplicationContext()
 */
class AmqpConfiguration
{
    const ORDERS_QUEUE = "amqp_orders";

    /**
     * Registers queue and exchange publisher
     * @Extension()
     */
    public function registerAmqpConfig(): array
    {
        $exchangeName = "fanout";
        $queueName = self::ORDERS_QUEUE;

        return [
            AmqpQueue::createWith($queueName),
            AmqpExchange::createFanoutExchange($exchangeName),
            AmqpBinding::createFromNames($exchangeName, $queueName, ""),

            RegisterAmqpPublisher::create(
                Publisher::class,
                $exchangeName,
                MediaType::APPLICATION_JSON
            )
                ->withAutoDeclareQueueOnSend(true)
        ];
    }
}