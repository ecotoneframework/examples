<?php


namespace Example\Scheduling\FixedRate;

use Ecotone\Messaging\Annotation\ApplicationContext;
use Ecotone\Messaging\Annotation\Extension;
use Ecotone\Messaging\Endpoint\PollingMetadata;

/**
 * @ApplicationContext()
 */
class MessagingConfiguration
{
    /**
     * @Extension()
     */
    public function configuration()
    {
        return PollingMetadata::create("personSynchronizer")
                ->setFixedRateInMilliseconds(1000)
                ->setInitialDelayInMilliseconds(500);
    }
}