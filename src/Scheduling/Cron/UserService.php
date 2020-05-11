<?php


namespace Example\Scheduling\Cron;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\Scheduled;
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
     * @Scheduled(
     *     endpointId="loggedUsersNotifactor",
     *     requestChannelName="markAsLoggedIn"
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