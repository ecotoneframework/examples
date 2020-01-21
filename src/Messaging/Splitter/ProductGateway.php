<?php


namespace Example\Messaging\Splitter;

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
    public function order(array $productNames) : void;
}