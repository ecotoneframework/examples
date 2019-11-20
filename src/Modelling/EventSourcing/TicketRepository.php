<?php


namespace Example\Modelling\EventSourcing;

use Ecotone\Modelling\Annotation\Repository;
use Ecotone\Modelling\InMemoryEventSourcedRepository;

/**
 * Class TicketRepository
 * @package Example\Modelling\EventSourcing
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @Repository()
 */
class TicketRepository extends InMemoryEventSourcedRepository
{

}