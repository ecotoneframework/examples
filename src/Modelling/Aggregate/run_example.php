<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;
use Example\Modelling\Aggregate\GetProductPriceQuery;
use Example\Modelling\Aggregate\ProductRepository;
use Example\Modelling\Aggregate\RegisterProductCommand;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([ProductRepository::createEmpty()]),
    ApplicationConfiguration::createWithDefaults()
        ->withLoadSrc(false)
        ->withNamespaces(["Example\Modelling\Aggregate"])
);

// Begin test scenario

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);


$commandBus->send(new RegisterProductCommand(123, "Table", 100));

$queryBus->send(new GetProductPriceQuery(123));
echo "Example passed\n";