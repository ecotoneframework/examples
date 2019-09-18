<?php


namespace Example\Modelling\Metadata;

/**
 * Class GetPerson
 * @package Example\Modelling\Metadata
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class GetPersonDetails
{
    /**
     * @var string
     */
    private $personId;

    /**
     * GetPerson constructor.
     * @param string $personId
     */
    public function __construct(string $personId)
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