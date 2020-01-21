<?php


namespace Example\Messaging\ServiceActivator;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\ServiceActivator;

/**
 * @MessageEndpoint()
 */
class Shop
{
    /**
     * @ServiceActivator(inputChannelName="buyProduct")
     */
    public function buyProduct(int $productId) : void
    {
        echo "Product with id {$productId} was bought";
    }
}