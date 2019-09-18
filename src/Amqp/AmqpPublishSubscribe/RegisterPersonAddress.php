<?php


namespace Example\Amqp\AmqpPublishSubscribe;

use JMS\Serializer\Annotation AS JMS;

/**
 * Class RegisterPersonAddress
 * @package Example\Amqp\AmqpPublishSubscribe
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class RegisterPersonAddress
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
    private $fullAddressName;

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
    public function getFullAddressName(): string
    {
        return $this->fullAddressName;
    }
}