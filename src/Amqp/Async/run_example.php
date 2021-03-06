<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Handler\Logger\EchoLogger;
use Ecotone\Modelling\EventBus;
use Enqueue\AmqpLib\AmqpConnectionFactory as AmqpLibConnection;
use Example\Amqp\Async\AmqpConfiguration;
use Example\Amqp\Async\Converter\FromJsonToPHPConverter;
use Example\Amqp\Async\Converter\FromPHPToJsonConverter;
use Example\Amqp\Async\PersonWasRegistered;
use Example\Amqp\Async\SendNotificationWhenPersonRegistered;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromAssociativeArray([
        AmqpLibConnection::class => new AmqpLibConnection(["dsn" => "amqp://rabbitmq:5672"]),
        SendNotificationWhenPersonRegistered::class => new SendNotificationWhenPersonRegistered(),
        "logger" => new EchoLogger(),
        FromJsonToPHPConverter::class => new FromJsonToPHPConverter(),
        FromPHPToJsonConverter::class => new FromPHPToJsonConverter()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\Amqp\Async"])
);


/** Test scenario */

/** @var EventBus $eventBus */
$eventBus = $messagingSystem->getGatewayByName(EventBus::class);

echo "Sending message Hello World \n";
$eventBus->send(new PersonWasRegistered(123));

$messagingSystem->runSeparatelyRunningEndpointBy(AmqpConfiguration::SEND_NOTIFICATION_CHANNEL);