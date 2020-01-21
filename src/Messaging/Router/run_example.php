<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Example\Messaging\Router\OrderGateway;
use Example\Messaging\Router\OrderService;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([new OrderService()]),
    ApplicationConfiguration::createWithDefaults()
        ->withLoadSrc(false)
        ->withNamespaces(["Example\Messaging\Router"])
);

// Begin test scenario

echo "Begin test scenario\n";

/** @var OrderGateway $productGateway */
$productGateway = $messagingSystem->getGatewayByName(OrderGateway::class);

echo "Ordering coffee\n";
$productGateway->order(["orderType" => "coffee"]);

echo "Ordering table\n";
$productGateway->order(["orderType" => "table"]);

echo "Example passed\n";