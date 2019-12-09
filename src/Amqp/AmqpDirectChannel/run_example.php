<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Handler\Logger\EchoLogger;
use Ecotone\Modelling\CommandBus;
use Enqueue\AmqpLib\AmqpConnectionFactory;
use Example\Amqp\AmqpDirectChannel\AmqpConfiguration;
use Example\Amqp\AmqpDirectChannel\AsynchronousMessageHandler;
use Example\Amqp\PublishReceive\AmqpMessageEndpoint;
use Psr\Log\NullLogger;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromAssociativeArray([
        AmqpConnectionFactory::class => new AmqpConnectionFactory(["dsn" => "amqp://rabbitmq:5672"]),
        AsynchronousMessageHandler::class => new AsynchronousMessageHandler(),
        "logger" => new EchoLogger()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withLoadSrc(false)
        ->withNamespaces(["Example\Amqp\AmqpDirectChannel"])
);

// Begin test scenario

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);

echo "Sending command message to Amqp Direct Channel \n";
$commandBus->convertAndSend(AmqpConfiguration::AMQP_CHANNEL_NAME, MediaType::TEXT_PLAIN, "doSomethingCommand");

echo "Receiving command message from Amqp Channel\n";
$messagingSystem->runSeparatelyRunningEndpointBy(AmqpMessageEndpoint::ENDPOINT_ID);