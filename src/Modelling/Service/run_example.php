<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;
use Example\Modelling\Service\BookstoreApi;
use Example\Modelling\Service\BuyBook;
use Example\Modelling\Service\GetBook;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createNoCache(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([new BookstoreApi()]),
    ["Example\Modelling\Service"]
);

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);

$commandBus->send(new BuyBook(123));

$queryBus->send(new GetBook(123));

echo "Example passed\n";