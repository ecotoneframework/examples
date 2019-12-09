<?php


namespace Example\CrossSystemCommunication\EventHandling\Notification;

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
class AmqpNotificationConfiguration
{
    const NOTIFICATION_QUEUE = "order";

    /**
     * Registers queue and exchange publisher
     *
     * @return array
     * @throws \Ecotone\Messaging\MessagingException
     * @Extension()
     */
    public function registerAmqpConfig(): array
    {
        $deliveryExchange = AmqpExchange::createFanoutExchange("order.events");
        $orderProcessQueue = AmqpQueue::createWith(self::NOTIFICATION_QUEUE);

        return [
            $deliveryExchange,
            $orderProcessQueue,
            AmqpBinding::createWith($deliveryExchange, $orderProcessQueue, null)
        ];
    }
}