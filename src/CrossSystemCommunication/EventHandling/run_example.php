<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Modelling\CommandBus;
use Enqueue\AmqpLib\AmqpConnectionFactory as AmqpLibConnection;
use Example\CrossSystemCommunication\EventHandling\Notification\Notificator;
use Example\CrossSystemCommunication\EventHandling\Shop\OrderApi;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$deliveryApplication = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        new AmqpLibConnection(["dsn" => "amqp://rabbitmq:5672"]),
        new Notificator()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withLoadSrc(false)
        ->withNamespaces(["Example\CrossSystemCommunication\EventHandling\Notification"])
);

$shopApplication = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        new AmqpLibConnection(["dsn" => "amqp://rabbitmq:5672"]),
        new OrderApi()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withLoadSrc(false)
        ->withNamespaces(["Example\CrossSystemCommunication\EventHandling\Shop"])
);

// Begin test scenario


// Notification application - receiving message
// It creates exchange and queue
// As message was not send yet, it runs for 100ms and quits (look @Poller in OrderProcessor)

$deliveryApplication->runSeparatelyRunningEndpointBy("notificator");

// Shop application - publishing event message

/** @var CommandBus $commandbus */
$commandbus = $shopApplication->getGatewayByName(CommandBus::class);

$commandbus->convertAndSend("order.accept", MediaType::TEXT_PLAIN, "buy car");

// Notification application - receiving message

$deliveryApplication->runSeparatelyRunningEndpointBy("notificator");

echo "Example passed\n";