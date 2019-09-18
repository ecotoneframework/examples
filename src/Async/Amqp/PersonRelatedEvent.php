<?php


namespace Example\Async\Amqp;

/**
 * Interface PersonRelatedEvent
 * @package Example\Async\Amqp
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface PersonRelatedEvent
{
    /**
     * @return string
     */
    public function getPersonId(): string;

}