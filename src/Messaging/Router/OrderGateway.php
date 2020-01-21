<?php


namespace Example\Messaging\Router;

use Ecotone\Messaging\Annotation\Gateway;
use Ecotone\Messaging\Annotation\MessageEndpoint;

/**
 * @MessageEndpoint()
 */
interface OrderGateway
{
    /**
     * @Gateway(requestChannel="order")
     */
    public function order(array $data) : void;
}