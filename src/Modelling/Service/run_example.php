<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\QueryBus;
use Example\Modelling\Service\BookstoreApi;
use Example\Modelling\Service\BuyBook;
use Example\Modelling\Service\GetBook;
use PHPUnit\Framework\Assert;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([new BookstoreApi()]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\Modelling\Service"])
);

// Begin test scenario

/** @var CommandBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);

$commandBus->send(new BuyBook(123));

$book = $queryBus->send(new GetBook(123));
Assert::assertEquals($book, 123);

echo "Example passed\n";