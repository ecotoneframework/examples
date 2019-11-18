<?php

use Example\Modelling\Aggregate\GetProductPriceQuery;
use Example\Modelling\Aggregate\ProductRepository;
use Example\Modelling\Aggregate\RegisterProductCommand;
use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;
use PHPUnit\Framework\Assert;
use Ramsey\Uuid\Uuid;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createNoCache(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([ProductRepository::createEmpty()]),
    ["Example\Modelling\Aggregate"]
);

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);


$commandBus->send(new RegisterProductCommand(123, "Table", 100));

$queryBus->send(new GetProductPriceQuery(123));
echo "Example passed\n";