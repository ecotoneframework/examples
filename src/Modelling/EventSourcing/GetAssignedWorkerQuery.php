<?php


namespace Example\Modelling\EventSourcing;


class GetAssignedWorkerQuery
{
    private $ticketId;

    public function __construct(string $ticketId)
    {
        $this->ticketId = $ticketId;
    }
}