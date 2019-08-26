<?php

use Ecotone\Amqp\AmqpPublisher;
use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Enqueue\AmqpLib\AmqpConnectionFactory as AmqpLibConnection;
use Example\Amqp\Conversion\FromJsonToPHPConverter;
use Example\Amqp\Conversion\FromPHPToJsonConverter;
use Example\Amqp\Conversion\Order;
use Example\Amqp\Conversion\OrderingEndpoint;
use Psr\Log\NullLogger;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createNoCache(
    $rootCatalog,
    InMemoryPSRContainer::createFromAssociativeArray([
        AmqpLibConnection::class => new AmqpLibConnection(["dsn" => "amqp://rabbitmq:5672"]),
        OrderingEndpoint::class => new OrderingEndpoint(),
        FromJsonToPHPConverter::class => new FromJsonToPHPConverter(),
        FromPHPToJsonConverter::class => new FromPHPToJsonConverter(),
        "logger" => new NullLogger()
    ]),
    ["Example\Amqp\Conversion"]
);



/** Test scenario */

/** @var AmqpPublisher $publisher */
$publisher = $messagingSystem->getGatewayByName(AmqpPublisher::class);

echo "Sending message Hello World \n";
$publisher->convertAndSend(new Order(100));

echo "Receiving message Hello World\n";
$messagingSystem->runSeparatelyRunningEndpointBy(OrderingEndpoint::ENDPOINT_ID);