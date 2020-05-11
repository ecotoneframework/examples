<?php


namespace Example\Scheduling\FixedRate;

use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\Scheduled;
use Ecotone\Modelling\Annotation\CommandHandler;
use Ramsey\Uuid\Uuid;

/**
 * @MessageEndpoint()
 */
class SynchronizationService
{
    /**
     * Run each second, with init delay half second
     *
     * @Scheduled(
     *     endpointId="personSynchronizer",
     *     requestChannelName="synchronizePerson"
     * )
     */
    public function getUserToSynchronize()
    {
        return Uuid::uuid4()->toString();
    }

    /**
     * @CommandHandler(inputChannelName="synchronizePerson")
     */
    public function synchronize(string $personId): void
    {
        echo "User {$personId} is being synchronized.\n";
    }
}