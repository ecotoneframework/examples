<?php


namespace Example\Modelling\Conversion;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\CommandHandler;
use Ecotone\Modelling\Annotation\QueryHandler;

/**
 * Class GuestBook
 * @package Example\Modelling\Conversion
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class GuestBook
{
    /**
     * @var Person[]
     */
    private $record = [];

    /**
     * @param Person $person
     * @CommandHandler(inputChannelName="guestBook.record")
     */
    public function record(Person $person) : void
    {
        $this->record[] = $person;
    }

    /**
     * @return Person[]
     * @QueryHandler(inputChannelName="guestBook.getRecorded")
     */
    public function getRecorded() : array
    {
        return $this->record;
    }
}