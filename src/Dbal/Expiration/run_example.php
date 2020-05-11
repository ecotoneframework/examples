<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Handler\Logger\EchoLogger;
use Ecotone\Modelling\CommandBus;
use Enqueue\Dbal\DbalConnectionFactory;
use Example\Dbal\Expiration\MessagingConfiguration;
use Example\Dbal\Expiration\OrderProcessor;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromAssociativeArray([
        DbalConnectionFactory::class => new DbalConnectionFactory('pgsql://ecotone:secret@database:5432/ecotone'),
        OrderProcessor::class => new OrderProcessor(),
        "logger" => new EchoLogger()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\Dbal\Expiration"])
);


/** Test scenario */

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);

echo "Sending message to be expired \n";
$commandBus->convertAndSend("placeOrder", MediaType::TEXT_PLAIN, "Expired Message");
echo "Waiting 11 seconds for message expiration\n";
sleep(11);
echo "Sending message polled right away \n";
$commandBus->convertAndSend("placeOrder", MediaType::TEXT_PLAIN, "Not Expired Message");

$messagingSystem->runSeparatelyRunningEndpointBy(MessagingConfiguration::SEND_ORDER_CHANNEL);