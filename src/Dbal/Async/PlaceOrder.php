<?php


namespace Example\Dbal\Async;

use JMS\Serializer\Annotation AS Serializer;

class PlaceOrder
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }
}