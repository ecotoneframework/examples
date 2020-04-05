<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Handler\Logger\EchoLogger;
use Ecotone\Messaging\Publisher;
use Enqueue\AmqpLib\AmqpConnectionFactory;
use Example\Amqp\DefaultExchange\Consumer;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromAssociativeArray([
        AmqpConnectionFactory::class => new AmqpConnectionFactory(["dsn" => "amqp://rabbitmq:5672"]),
        Consumer::class => new Consumer(),
        "logger" => new EchoLogger()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\Amqp\DefaultExchange"])
);

// Begin test scenario

/** @var Publisher $publisher */
$publisher = $messagingSystem->getGatewayByName(Publisher::class);

echo "Sending message using Publisher \n";
$publisher->send("Hello new message!");

echo "Receiving message using Consumer\n";
$messagingSystem->runSeparatelyRunningEndpointBy(Consumer::ENDPOINT_ID);