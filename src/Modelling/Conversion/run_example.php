<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;
use Example\Modelling\Conversion\FromJsonToPHPConverter;
use Example\Modelling\Conversion\FromPHPToJsonConverter;
use Example\Modelling\Conversion\GuestBook;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        new GuestBook(),
        new FromJsonToPHPConverter(),
        new FromPHPToJsonConverter()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\Modelling\Conversion"])
);

// Begin test scenario

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);

echo "Sending message, which need to converted from json to PHP\n";
$commandBus->convertAndSend("guestBook.record", MediaType::APPLICATION_JSON, json_encode([
    "fistName" => "Johny",
    "lastName" => "Bravo"
]));

echo "Receving recorded person\n";
$results = $queryBus->convertAndSend("guestBook.getRecorded", MediaType::APPLICATION_JSON, []);


echo "Example passed\n";