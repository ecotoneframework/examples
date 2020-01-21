<?php


namespace Example\Messaging\ServiceActivator;

use Ecotone\Messaging\Annotation\Gateway;
use Ecotone\Messaging\Annotation\MessageEndpoint;

/**
 * @MessageEndpoint()
 */
interface ProductGateway
{
    /**
     * @Gateway(requestChannel="buyProduct")
     */
    public function buyProduct(int $productId) : void;
}