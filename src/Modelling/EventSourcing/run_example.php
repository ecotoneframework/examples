<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\CommandBusWithEventPublishing;
use Ecotone\Modelling\QueryBus;
use Example\Modelling\EventSourcing\AssignWorkerCommand;
use Example\Modelling\EventSourcing\GetAssignedWorkerQuery;
use Example\Modelling\EventSourcing\NotificationService;
use Example\Modelling\EventSourcing\StartTicketCommand;
use Example\Modelling\EventSourcing\TicketRepository;
use PHPUnit\Framework\Assert;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        new NotificationService(), TicketRepository::createEmpty()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withLoadSrc(false)
        ->withNamespaces(["Example\Modelling\EventSourcing"])
);

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);

$commandBus->send(new StartTicketCommand(1));
$commandBus->send(new AssignWorkerCommand(1, 100));

Assert::assertEquals(100, $queryBus->send(new GetAssignedWorkerQuery(1)));

echo "Example passed\n";