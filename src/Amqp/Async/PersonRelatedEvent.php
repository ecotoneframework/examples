<?php


namespace Example\Amqp\Async;

/**
 * Interface PersonRelatedEvent
 * @package Example\Amqp\Async
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
interface PersonRelatedEvent
{
    /**
     * @return string
     */
    public function getPersonId(): string;

}