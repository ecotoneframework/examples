<?php


namespace Example\Modelling\AggregateWithEventPublishing\Command;

/**
 * Class OpenStorage
 * @package Ecotone\Modelling\AggregateWithEventPublishing
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class OpenStorage
{
    /**
     * @var string
     */
    private $storageId;
    /**
     * @var int
     */
    private $capacity;

    /**
     * OpenStorage constructor.
     * @param string $storageId
     * @param int $capacity
     */
    public function __construct(string $storageId, int $capacity)
    {
        $this->storageId = $storageId;
        $this->capacity = $capacity;
    }

    /**
     * @return string
     */
    public function getStorageId(): string
    {
        return $this->storageId;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }
}