<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\CommandBusWithEventPublishing;
use Example\Modelling\AggregateWithEventPublishing\Box;
use Example\Modelling\AggregateWithEventPublishing\Command\OpenStorage;
use Example\Modelling\AggregateWithEventPublishing\Command\RegisterBox;
use Example\Modelling\AggregateWithEventPublishing\StorageRepository;
use Example\Modelling\AggregateWithEventPublishing\StorageSupervisor;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        StorageRepository::createEmpty(),
        new StorageSupervisor()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withLoadSrc(false)
        ->withNamespaces(["Example\Modelling\AggregateWithEventPublishing"])
);

// Begin test scenario

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);

$commandBus->send(new OpenStorage(123, 2));
$commandBus->send(new RegisterBox(123, new Box(1)));
$commandBus->send(new RegisterBox(123, new Box(2)));

echo "Registering box, which will result in exceeding available capacity\n";
$commandBus->send(new RegisterBox(123, new Box(3)));

echo "Example passed\n";