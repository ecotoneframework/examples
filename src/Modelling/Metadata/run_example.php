<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Modelling\QueryBus;
use Example\Modelling\Metadata\GetPersonDetails;
use Example\Modelling\Metadata\PersonDetailsService;
use PHPUnit\Framework\Assert;

$rootCatalog = realpath(__DIR__ . "/../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createNoCache(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([new PersonDetailsService()]),
    ["Example\Modelling\Metadata"]
);


/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);

echo "Sending query with metadata\n";

$result = $queryBus->sendWithMetadata(new GetPersonDetails(123), [
    "executorPersonId" => 123
]);
Assert::assertEquals($result, ["name" => "johny"]);

echo "Example passed\n";