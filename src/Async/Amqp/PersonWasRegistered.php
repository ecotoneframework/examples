<?php


namespace Example\Async\Amqp;

use JMS\Serializer\Annotation AS Serializer;

class PersonWasRegistered implements PersonRelatedEvent
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $personId;

    /**
     * PersonWasRegistered constructor.
     * @param $personId
     */
    public function __construct($personId)
    {
        $this->personId = $personId;
    }

    /**
     * @return string
     */
    public function getPersonId(): string
    {
        return $this->personId;
    }
}