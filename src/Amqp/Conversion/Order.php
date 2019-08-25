<?php


namespace Example\Amqp\Conversion;

use JMS\Serializer\Annotation AS Serializer;

/**
 * Class Order
 * @package Ecotone\Amqp\Conversion
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class Order
{
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("orderId")
     */
    private $orderId;

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }
}