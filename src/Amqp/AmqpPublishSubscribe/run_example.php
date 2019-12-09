<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Messaging\Handler\Logger\EchoLogger;
use Ecotone\Modelling\CommandBus;
use Enqueue\AmqpLib\AmqpConnectionFactory;
use Example\Amqp\AmqpPublishSubscribe\AmqpConfiguration;
use Example\Amqp\AmqpPublishSubscribe\Converter\FromJsonToPHPConverter;
use Example\Amqp\AmqpPublishSubscribe\Converter\FromPHPToJsonConverter;
use Example\Amqp\AmqpPublishSubscribe\PersonAddressHandler;
use Example\Amqp\AmqpPublishSubscribe\RegisterPersonProfileHandler;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromAssociativeArray([
        AmqpConnectionFactory::class => new AmqpConnectionFactory(["dsn" => "amqp://rabbitmq:5672"]),
        PersonAddressHandler::class => new PersonAddressHandler(),
        RegisterPersonProfileHandler::class => new RegisterPersonProfileHandler(),
        FromJsonToPHPConverter::class => new FromJsonToPHPConverter(),
        FromPHPToJsonConverter::class => new FromPHPToJsonConverter(),
        "logger" => new EchoLogger()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withLoadSrc(false)
        ->withNamespaces(["Example\Amqp\AmqpPublishSubscribe"])
);

// Begin test scenario

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);

echo "Sending event message to Amqp Publish Subscribe Channel \n";
$commandBus->convertAndSend(AmqpConfiguration::PERSON_REGISTER_CHANNEL, MediaType::APPLICATION_JSON, json_encode([
    "personId" => 1,
    "fullAddressName" => "Donkey street 14th",
    "name" => "Johny"
]));

echo "Receiving message from Amqp Channel\n";
$messagingSystem->runSeparatelyRunningEndpointBy(PersonAddressHandler::ENDPOINT_ID);
$messagingSystem->runSeparatelyRunningEndpointBy(RegisterPersonProfileHandler::ENDPOINT_ID);

echo "Example passed\n";