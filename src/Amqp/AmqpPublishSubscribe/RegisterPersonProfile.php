<?php


namespace Example\Amqp\AmqpPublishSubscribe;

use JMS\Serializer\Annotation AS JMS;

/**
 * Class RegisterPersonAddress
 * @package Example\Amqp\AmqpPublishSubscribe
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class RegisterPersonProfile
{
    /**
     * @var string
     * @JMS\Type("string")
     */
    private $personId;
    /**
     * @var string
     * @JMS\Type("string")
     */
    private $name;

    /**
     * @return string
     */
    public function getPersonId(): string
    {
        return $this->personId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}