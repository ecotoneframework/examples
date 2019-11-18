<?php


namespace Example\Modelling\Service;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Modelling\Annotation\CommandHandler;
use Ecotone\Modelling\Annotation\EventHandler;
use Ecotone\Modelling\Annotation\QueryHandler;
use Ecotone\Modelling\EventBus;

/**
 * @MessageEndpoint()
 */
class BookstoreApi
{
    /**
     * @CommandHandler()
     */
    public function buyBook(BuyBook $command, EventBus $eventBus) : void
    {
        echo "Received BuyBook command\n";

        $eventBus->send(new BookBought($command->getBookId()));
    }

    /**
     * @QueryHandler()
     */
    public function getBook(GetBook $query) : string
    {
        echo "Received GetBook query\n";

        return $query->getBookId();
    }

    /**
     * @EventHandler()
     */
    public function notifyAboutBoughtBook(BookBought $event) : void
    {
        echo "Received BookBought event\n";
    }
}