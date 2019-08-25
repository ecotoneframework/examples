<?php


namespace Example\Amqp\Conversion;

use Ecotone\Amqp\Annotation\AmqpEndpoint;
use Ecotone\Messaging\Annotation\MessageEndpoint;

/**
 * Class CommandConsumer
 * @package Example\Amqp\PublishReceive
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class OrderingEndpoint
{
    const ENDPOINT_ID = "orderingEndpoint";

    /**
     * @AmqpEndpoint(
     *     endpointId=OrderingEndpoint::ENDPOINT_ID,
     *     queueName="orders"
     * )
     * @param Order $order
     */
    public function execute(Order $order) : void
    {
        echo "Received Order object\n";
        var_dump($order);
        die("Example passed\n");
    }
}