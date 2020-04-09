<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Publisher;
use Ecotone\Modelling\CommandBus;
use Enqueue\AmqpLib\AmqpConnectionFactory as AmqpLibConnection;
use Example\CrossSystemCommunication\CommandHandling\Delivery\AmqpDeliveryConfiguration;
use Example\CrossSystemCommunication\CommandHandling\Delivery\OrderProcessor;
use Example\CrossSystemCommunication\CommandHandling\Shop\OrderApi;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$deliveryApplication = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        new AmqpLibConnection(["dsn" => "amqp://rabbitmq:5672"]),
        new OrderProcessor()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\CrossSystemCommunication\CommandHandling\Delivery"])
);

$shopApplication = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        new AmqpLibConnection(["dsn" => "amqp://rabbitmq:5672"]),
        new OrderApi()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\CrossSystemCommunication\CommandHandling\Shop"])
);

// Begin test scenario


// Delivery application - receiving message
// It creates exchange and queue
// As message was not send yet, it runs for 100ms and quits (look @Poller in OrderProcessor)

$deliveryApplication->runSeparatelyRunningEndpointBy("orderProcessor");


// Shop application - publishing message

/** @var CommandBus $commandbus */
$commandbus = $shopApplication->getGatewayByName(CommandBus::class);

$commandbus->convertAndSend("order.accept", MediaType::TEXT_PLAIN, "buy car");

// Delivery application - receiving message

$deliveryApplication->runSeparatelyRunningEndpointBy("orderProcessor");

echo "Example passed\n";