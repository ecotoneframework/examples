<?php


namespace Example\Modelling\EventSourcing;


class TicketWasStartedEvent
{
    /**
     * @var string
     */
    private $ticketId;

    /**
     * TicketWasStarted constructor.
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