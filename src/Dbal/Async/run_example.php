<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Handler\Logger\EchoLogger;
use Ecotone\Modelling\CommandBus;
use Enqueue\Dbal\DbalConnectionFactory;
use Example\Dbal\Async\DbalConfiguration;
use Example\Dbal\Async\Converter\FromJsonToPHPConverter;
use Example\Dbal\Async\Converter\FromPHPToJsonConverter;
use Example\Dbal\Async\PlaceOrder;
use Example\Dbal\Async\OrderProcessor;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromAssociativeArray([
        DbalConnectionFactory::class => new DbalConnectionFactory('pgsql://ecotone:secret@database:5432/ecotone'),
        OrderProcessor::class => new OrderProcessor(),
        "logger" => new EchoLogger(),
        FromJsonToPHPConverter::class => new FromJsonToPHPConverter(),
        FromPHPToJsonConverter::class => new FromPHPToJsonConverter()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\Dbal\Async"])
);


/** Test scenario */

/** @var CommandBus $eventBus */
$eventBus = $messagingSystem->getGatewayByName(CommandBus::class);

echo "Sending message Hello World \n";
$eventBus->send(new PlaceOrder(123));

$messagingSystem->runSeparatelyRunningEndpointBy(DbalConfiguration::SEND_ORDER_CHANNEL);