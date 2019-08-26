<?php


namespace Example\Modelling\Service;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\CommandHandler;
use Ecotone\Modelling\Annotation\EventHandler;
use Ecotone\Modelling\Annotation\QueryHandler;
use Ecotone\Modelling\EventBus;

/**
 * Class ApiService
 * @package Ecotone\Modelling\Service
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @MessageEndpoint()
 */
class BookstoreApi
{
    /**
     * @CommandHandler()
     * @param BuyBook $command
     * @param EventBus $eventBus
     */
    public function buyBook(BuyBook $command, EventBus $eventBus) : void
    {
        echo "Received BuyBook command\n";
        $eventBus->send(new BookBought($command->getBookId()));
    }

    /**
     * @QueryHandler()
     * @param GetBook $query
     */
    public function getBook(GetBook $query)
    {
        echo "Received GetBook query\n";
    }

    /**
     * @EventHandler()
     * @param BookBought $event
     */
    public function notifyAboutBoughtBook(BookBought $event) : void
    {
        echo "Received BookBought event\n";
    }
}