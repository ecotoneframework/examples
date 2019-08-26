<?php


namespace Example\Modelling\AggregateWithEventPublishing;

/**
 * Class Box
 * @package Ecotone\Modelling\AggregateWithEventPublishing
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class Box
{
    /**
     * @var string
     */
    private $boxId;

    /**
     * Box constructor.
     * @param string $boxId
     */
    public function __construct(string $boxId)
    {
        $this->boxId = $boxId;
    }

    /**
     * @param Box $toCompare
     * @return bool
     */
    public function isSameAs(Box $toCompare) : bool
    {
        return $this == $toCompare;
    }

    /**
     * @return string
     */
    public function getBoxId(): string
    {
        return $this->boxId;
    }
}