<?php


namespace Example\CrossSystemCommunication\CommandHandling\Delivery;

use Ecotone\Amqp\AmqpBinding;
use Ecotone\Amqp\AmqpExchange;
use Ecotone\Amqp\AmqpQueue;
use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;

/**
 * Class AmqpConfiguration
 * @package Example\Amqp\PublishReceive
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @ApplicationContext()
 */
class AmqpDeliveryConfiguration
{
    const ORDER_PROCESS_QUEUE = "order";
    const ORDER_PROCESSOR_ROUTING_KEY = "ecotone.order.process";

    /**
     * Registers queue and exchange publisher
     *
     * @return array
     * @throws \Ecotone\Messaging\MessagingException
     * @Extension()
     */
    public function registerAmqpConfig(): array
    {
        $deliveryExchange = AmqpExchange::createDirectExchange("delivery");
        $orderProcessQueue = AmqpQueue::createWith(self::ORDER_PROCESS_QUEUE);

        return [
            $deliveryExchange,
            $orderProcessQueue,
            AmqpBinding::createWith($deliveryExchange, $orderProcessQueue, self::ORDER_PROCESSOR_ROUTING_KEY)
        ];
    }
}