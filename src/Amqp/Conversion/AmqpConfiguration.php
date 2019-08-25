<?php


namespace Example\Amqp\Conversion;

use Ecotone\Amqp\AmqpPublisher;
use Ecotone\Amqp\AmqpQueue;
use Ecotone\Amqp\Configuration\RegisterAmqpPublisher;
use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;
use Ecotone\Messaging\Conversion\MediaType;

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
     * @Extension()
     */
    public function registerAmqpConfig(): array
    {
        return [
            AmqpQueue::createWith("orders"),

            RegisterAmqpPublisher::create(
                AmqpPublisher::class
            )->withAutoDeclareQueueOnSend(true)
        ];
    }
}