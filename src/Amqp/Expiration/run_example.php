<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Handler\Logger\EchoLogger;
use Ecotone\Modelling\CommandBus;
use Enqueue\AmqpLib\AmqpConnectionFactory as AmqpLibConnection;
use Example\Amqp\Expiration\MessagingConfiguration;
use Example\Amqp\Expiration\OrderProcessor;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromAssociativeArray([
        AmqpLibConnection::class => new AmqpLibConnection(["dsn" => "amqp://rabbitmq:5672"]),
        OrderProcessor::class => new OrderProcessor(),
        "logger" => new EchoLogger()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\Amqp\Expiration"])
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