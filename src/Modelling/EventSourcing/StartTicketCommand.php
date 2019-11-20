<?php


namespace Example\Modelling\EventSourcing;


class StartTicketCommand
{
    /**
     * @var string
     */
    private $ticketId;

    /**
     * StartTicketCommand constructor.
     * @param string $ticketId
     */
    public function __construct(string $ticketId)
    {
        $this->ticketId = $ticketId;
    }

    /**
     * @return string
     */
    public function getTicketId(): string
    {
        return $this->ticketId;
    }
}