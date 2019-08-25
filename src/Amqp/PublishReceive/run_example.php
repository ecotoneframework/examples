<?php

use Ecotone\Amqp\AmqpPublisher;
use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Conversion\MediaType;
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
        "logger" => new NullLogger()
    ]),
    ["Example\Amqp\PublishReceive"]
);

/** @var AmqpPublisher $publisher */
$publisher = $messagingSystem->getGatewayByName(AmqpPublisher::class);

echo "Sending message Hello World \n";
$publisher->send("Hello World", MediaType::TEXT_PLAIN, "messages");

echo "Receiving message Hello World\n";
$messagingSystem->runSeparatelyRunningEndpointBy(AmqpMessageEndpoint::ENDPOINT_ID);