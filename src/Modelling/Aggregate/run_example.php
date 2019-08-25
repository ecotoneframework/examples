<?php

use Example\Modelling\Aggregate\GetProductPrice;
use Example\Modelling\Aggregate\ProductRepository;
use Example\Modelling\Aggregate\RegisterProduct;
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

echo "Command - Registering product\n";
$commandBus->send(new RegisterProduct(123, "Table", 100));

echo "Query - Verifying if product has defined price \n";
Assert::assertEquals(
    100,
    $queryBus->send(new GetProductPrice(123))
);
echo "Example passed\n";