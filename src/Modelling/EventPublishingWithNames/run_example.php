<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Modelling\EventBus;
use Example\Modelling\EventPublishingWithNames\ProductListener;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        new ProductListener(),
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\Modelling\EventPublishingWithNames"])
);

// Begin test scenario

/** @var EventBus $eventBus */
$eventBus = $messagingSystem->getGatewayByName(EventBus::class);

$eventBus->convertAndSend("ecotone.product.registered", MediaType::APPLICATION_X_PHP, "productRegistered");

echo "Example passed\n";