<?php


namespace Example\Scheduling\Cron;

use Ecotone\Messaging\Annotation\InboundChannelAdapter;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\Poller;
use Ecotone\Modelling\Annotation\CommandHandler;
use Ramsey\Uuid\Uuid;

/**
 * @MessageEndpoint()
 */
class UserService
{
    /**
     * Run each minute
     *
     * @InboundChannelAdapter(
     *     endpointId="loggedUsersNotifactor",
     *     requestChannelName="markAsLoggedIn",
     *     poller=@Poller(
     *          cron="* * * * *"
     *     )
     * )
     */
    public function keepVerifyLoggedUsers()
    {
        return Uuid::uuid4()->toString();
    }


    /**
     * @CommandHandler(inputChannelName="markAsLoggedIn")
     */
    public function handleUserLoggedIn(string $personId): void
    {
        echo "User {$personId} is logged in.\n";
    }
}