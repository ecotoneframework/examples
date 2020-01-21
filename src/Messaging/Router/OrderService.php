<?php


namespace Example\Messaging\Router;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\Router;
use Ecotone\Messaging\Annotation\ServiceActivator;

/**
 * @MessageEndpoint()
 */
class OrderService
{
    /**
     * @Router(inputChannelName="order")
     */
    public function orderSpecificType(array $payload) : string
    {
        return $payload['orderType'] === 'coffee' ? "orderInCoffeeShop" : "orderInGeneralShop";
    }

    /**
     * @ServiceActivator(inputChannelName="orderInCoffeeShop")
     */
    public function orderInCoffeeShop() : void
    {
        echo "Ordered in coffee shop\n";
    }

    /**
     * @ServiceActivator(inputChannelName="orderInGeneralShop")
     */
    public function orderInGeneralShop() : void
    {
        echo "Ordered in general shop\n";
    }
}