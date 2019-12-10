<?php


namespace Example\Scheduling\FixedRate;

use Ecotone\Messaging\Annotation\InboundChannelAdapter;
use Ecotone\Messaging\Annotation\MessageEndpoint;
use Ecotone\Messaging\Annotation\Poller;
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
     * @InboundChannelAdapter(
     *     endpointId="personSynchronizer",
     *     requestChannelName="synchronizePerson",
     *     poller=@Poller(
     *          fixedRateInMilliseconds=1000,
     *          initialDelayInMilliseconds=500
     *     )
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