<?php


namespace Example\Messaging\Splitter;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\Splitter;
use Ecotone\Messaging\Annotation\ServiceActivator;

/**
 * @MessageEndpoint()
 */
class Shop
{
    /**
     * @Splitter(inputChannelName="buyProduct", outputChannelName="buySingleProduct")
     */
    public function sendMultipleOrders(array $products) : array
    {
        return $products;
    }

    /**
     * @ServiceActivator(inputChannelName="buySingleProduct")
     */
    public function buyProduct(string $productName) : void
    {
        echo "Product {$productName} was bought\n";
    }
}