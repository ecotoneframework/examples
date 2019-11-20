<?php


namespace Example\Modelling\EventSourcing;


use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\EventHandler;

/**
 * @MessageEndpoint()
 */
class NotificationService
{
    /**
     * @EventHandler()
     */
    public function notify(TicketWasStartedEvent $event) : void
    {
        echo "Ticket was created {$event->getTicketId()}\n";
    }
}