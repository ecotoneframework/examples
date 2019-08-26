<?php


namespace Example\Modelling\AggregateWithEventPublishing\Event;

/**
 * Class BoxWasRegistered
 * @package Ecotone\Modelling\AggregateWithEventPublishing
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class BoxWasRegistered implements StorageEvent
{
    /**
     * @var string
     */
    private $storageId;
    /**
     * @var string
     */
    private $boxId;

    /**
     * StorageWasOpened constructor.
     * @param string $storageId
     * @param string $boxId
     */
    public function __construct(string $storageId, string $boxId)
    {
        $this->storageId = $storageId;
        $this->boxId = $boxId;
    }

    /**
     * @return string
     */
    public function getStorageId(): string
    {
        return $this->storageId;
    }

    /**
     * @return string
     */
    public function getBoxId(): string
    {
        return $this->boxId;
    }
}