<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Handler\Logger\EchoLogger;
use Ecotone\Messaging\Publisher;
use Enqueue\AmqpLib\AmqpConnectionFactory as AmqpLibConnection;
use Example\Amqp\PublishReceive\AmqpMessageEndpoint;
use Psr\Log\NullLogger;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createNoCache(
    $rootCatalog,
    InMemoryPSRContainer::createFromAssociativeArray([
        AmqpLibConnection::class => new AmqpLibConnection(["dsn" => "amqp://rabbitmq:5672"]),
        AmqpMessageEndpoint::class => new AmqpMessageEndpoint(),
        "logger" => new EchoLogger()
    ]),
    ["Example\Amqp\PublishReceive"]
);

/** @var Publisher $publisher */
$publisher = $messagingSystem->getGatewayByName(Publisher::class);

echo "Sending message Hello World \n";
$publisher->sendWithMetadata("Hello World", ["amqpRouting" => "messages"],MediaType::TEXT_PLAIN);

echo "Receiving message Hello World\n";
$messagingSystem->runSeparatelyRunningEndpointBy(AmqpMessageEndpoint::ENDPOINT_ID);