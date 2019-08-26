<?php


namespace Example\Modelling\EventPublishingWithNames;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\EventHandler;

/**
 * Class EventListener
 * @package Example\Modelling\EventPublishingWithNames
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class ProductListener
{
    /**
     * @param string $message
     * @EventHandler(listenTo="ecotone.product.registered")
     */
    public function listenForProductRegistered(string $message) : void
    {
        echo "Received for ProductRegistered listener {$message}\n";
    }

    /**
     * @param string $message
     * @EventHandler(listenTo="ecotone.product.changed")
     */
    public function listenForProductChanged(string $message) : void
    {
        echo "Received for ProductChanged listener {$message}\n";
    }

    /**
     * @param string $message
     * @EventHandler(listenTo="ecotone.product.*")
     */
    public function listenForAllProductEvents(string $message) : void
    {
        echo "Received for all events listener {$message}\n";
    }
}