<?php


namespace Example\Modelling\AggregateWithEventPublishing\Command;

use Example\Modelling\AggregateWithEventPublishing\Box;

/**
 * Class RegisterBox
 * @package Example\Modelling\AggregateWithEventPublishing\Command
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class RegisterBox
{
    /**
     * @var string
     */
    private $storageId;
    /**
     * @var Box
     */
    private $box;

    /**
     * RegisterBox constructor.
     * @param string $storageId
     * @param Box $box
     */
    public function __construct(string $storageId, Box $box)
    {
        $this->box = $box;
        $this->storageId = $storageId;
    }

    /**
     * @return string
     */
    public function getStorageId(): string
    {
        return $this->storageId;
    }

    /**
     * @return Box
     */
    public function getBox(): Box
    {
        return $this->box;
    }
}