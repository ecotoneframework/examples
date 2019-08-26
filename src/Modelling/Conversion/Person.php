<?php


namespace Example\Modelling\Conversion;

use JMS\Serializer\Annotation AS JMS;

/**
 * Class Person
 * @package Example\Modelling\Conversion
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class Person
{
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("firstName")
     */
    private $firstName;
    /**
     * @var string
     * @JMS\Type("string")
     * @JMS\SerializedName("lastName")
     */
    private $lastName;

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
}