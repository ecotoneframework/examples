<?php


namespace Example\Scheduling\Cron;

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
        return PollingMetadata::create("loggedUsersNotifactor")
                ->setCron("* * * * *");
    }
}