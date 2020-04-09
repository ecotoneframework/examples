<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Example\Scheduling\Cron\LoggedUserNotificator;
use Example\Scheduling\Cron\UserService;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        new UserService()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\Scheduling\Cron"])
);

// Begin test scenario

echo "Wait minute for cron...\n";

$messagingSystem->runSeparatelyRunningEndpointBy("loggedUsersNotifactor");

echo "Example passed\n";