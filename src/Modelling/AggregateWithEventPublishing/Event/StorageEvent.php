<?php


namespace Example\Modelling\AggregateWithEventPublishing\Event;

/**
 * Interface StorageEvent
 * @package Ecotone\Modelling\AggregateWithEventPublishing
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface StorageEvent
{
    /**
     * @return string
     */
    public function getStorageId(): string;
}