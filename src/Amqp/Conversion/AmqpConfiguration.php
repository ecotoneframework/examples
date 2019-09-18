<?php


namespace Example\Amqp\Conversion;

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
 * Class AmqpConfiguration
 * @package Example\Amqp\PublishReceive
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @ApplicationContext()
 */
class AmqpConfiguration
{
    /**
     * Registers queue and exchange publisher
     *
     * @return array
     * @throws \Ecotone\Messaging\MessagingException
     * @Extension()
     */
    public function registerAmqpConfig(): array
    {
        $exchangeName = "fanout";
        $queueName = "orders";
        return [
            AmqpQueue::createWith($queueName),
            AmqpExchange::createFanoutExchange($exchangeName),
            AmqpBinding::createFromNames($exchangeName, $queueName, ""),

            RegisterAmqpPublisher::create(
                Publisher::class,
                AmqpConnectionFactory::class,
                $exchangeName,
                MediaType::APPLICATION_JSON
            )->withAutoDeclareQueueOnSend(true)
        ];
    }
}