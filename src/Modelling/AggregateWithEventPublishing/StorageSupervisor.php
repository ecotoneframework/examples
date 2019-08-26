<?php


namespace Example\Modelling\AggregateWithEventPublishing;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\EventHandler;
use Example\Modelling\AggregateWithEventPublishing\Event\BoxWasRegistered;
use Example\Modelling\AggregateWithEventPublishing\Event\StorageEvent;
use Example\Modelling\AggregateWithEventPublishing\Event\StorageRanOutOfCapacity;

/**
 * Class StorageSupervisor
 * @package Ecotone\Modelling\AggregateWithEventPublishing
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class StorageSupervisor
{
    /**
     * @EventHandler()
     * @param StorageEvent $event
     */
    public function storeLog(StorageEvent $event) : void
    {
        echo "Log storage related event " . get_class($event)  ."\n";
    }

    /**
     * @EventHandler()
     * @param BoxWasRegistered $event
     */
    public function informSecurity(BoxWasRegistered $event) : void
    {
        echo "Security informed about new box " . $event->getStorageId() . "\n";
    }

    /**
     * @EventHandler()
     * @param StorageRanOutOfCapacity $event
     */
    public function informSalesManagement(StorageRanOutOfCapacity $event) : void
    {
        echo "Inform Sales Management, we need to increase storage capacity for " . $event->getStorageId() . "\n";
    }
}