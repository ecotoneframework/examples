<?php


namespace Example\Modelling\AggregateWithEventPublishing\Event;

/**
 * Class StorageRanOutOfCapacity
 * @package Ecotone\Modelling\AggregateWithEventPublishing
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class StorageRanOutOfCapacity implements StorageEvent
{
    /**
     * @var string
     */
    private $storageId;

    /**
     * StorageWasOpened constructor.
     * @param string $storageId
     */
    public function __construct(string $storageId)
    {
        $this->storageId = $storageId;
    }

    /**
     * @return string
     */
    public function getStorageId(): string
    {
        return $this->storageId;
    }
}