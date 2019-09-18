<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Handler\Logger\EchoLogger;
use Ecotone\Modelling\EventBus;
use Enqueue\AmqpLib\AmqpConnectionFactory as AmqpLibConnection;
use Example\Async\Amqp\AmqpConfiguration;
use Example\Async\Amqp\Converter\FromJsonToPHPConverter;
use Example\Async\Amqp\Converter\FromPHPToJsonConverter;
use Example\Async\Amqp\PersonWasRegistered;
use Example\Async\Amqp\SendNotificationWhenPersonRegistered;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createNoCache(
    $rootCatalog,
    InMemoryPSRContainer::createFromAssociativeArray([
        AmqpLibConnection::class => new AmqpLibConnection(["dsn" => "amqp://rabbitmq:5672"]),
        SendNotificationWhenPersonRegistered::class => new SendNotificationWhenPersonRegistered(),
        "logger" => new EchoLogger(),
        FromJsonToPHPConverter::class => new FromJsonToPHPConverter(),
        FromPHPToJsonConverter::class => new FromPHPToJsonConverter()
    ]),
    ["Example\Async\Amqp"]
);


/** Test scenario */

/** @var EventBus $eventBus */
$eventBus = $messagingSystem->getGatewayByName(EventBus::class);

echo "Sending message Hello World \n";
$eventBus->send(new PersonWasRegistered(123));

$messagingSystem->runSeparatelyRunningEndpointBy(AmqpConfiguration::SEND_NOTIFICATION_CHANNEL);