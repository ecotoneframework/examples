<?php

use Ecotone\Amqp\AmqpPublisher;
use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Conversion\MediaType;
use Enqueue\AmqpLib\AmqpConnectionFactory as AmqpLibConnection;
use Example\Amqp\Conversion\JsonMediaTypeConverter;
use Example\Amqp\Conversion\OrderingEndpoint;
use Psr\Log\NullLogger;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createNoCache(
    $rootCatalog,
    InMemoryPSRContainer::createFromAssociativeArray([
        AmqpLibConnection::class => new AmqpLibConnection(["dsn" => "amqp://rabbitmq:5672"]),
        OrderingEndpoint::class => new OrderingEndpoint(),
        JsonMediaTypeConverter::class => new JsonMediaTypeConverter(),
        "logger" => new NullLogger()
    ]),
    ["Example\Amqp\Conversion"]
);

/** @var AmqpPublisher $publisher */
$publisher = $messagingSystem->getGatewayByName(AmqpPublisher::class);

echo "Sending message Hello World \n";
$publisher->send(json_encode(["orderId" => 100]), MediaType::APPLICATION_JSON, "orders");

echo "Receiving message Hello World\n";
$messagingSystem->runSeparatelyRunningEndpointBy(OrderingEndpoint::ENDPOINT_ID);