<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Example\Messaging\Splitter\ProductGateway;
use Example\Messaging\Splitter\Shop;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([new Shop()]),
    ApplicationConfiguration::createWithDefaults()
        ->withLoadSrc(false)
        ->withNamespaces(["Example\Messaging\Splitter"])
);

// Begin test scenario

echo "Begin test scenario\n";

/** @var ProductGateway $productGateway */
$productGateway = $messagingSystem->getGatewayByName(ProductGateway::class);
$productGateway->order(["dishwasher", "table", "chair"]);

echo "Example passed\n";