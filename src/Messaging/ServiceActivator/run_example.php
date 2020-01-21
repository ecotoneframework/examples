<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Example\Messaging\ServiceActivator\ProductGateway;
use Example\Messaging\ServiceActivator\Shop;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([new Shop()]),
    ApplicationConfiguration::createWithDefaults()
        ->withLoadSrc(false)
        ->withNamespaces(["Example\Messaging\ServiceActivator"])
);

// Begin test scenario

echo "Begin test scenario\n";

/** @var ProductGateway $productGateway */
$productGateway = $messagingSystem->getGatewayByName(ProductGateway::class);
$productGateway->buyProduct(123);

echo "Example passed\n";