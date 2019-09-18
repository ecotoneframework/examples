<?php


namespace Example\Modelling\Metadata;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\QueryHandler;

/**
 * Class PersonReadModelService
 * @package Example\Modelling\Metadata
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class PersonDetailsService
{
    /**
     * @param GetPersonDetails $query
     * @param array $metadata
     * @return array
     *
     * @QueryHandler()
     */
    public function getPersonById(GetPersonDetails $query, array $metadata) : array
    {
        if ($query->getPersonId() != $metadata['executorPersonId']) {
            throw new \InvalidArgumentException("You do not have enough permissions to perform this action");
        }
        
        return [
            "name" => "johny"
        ];
    }
}