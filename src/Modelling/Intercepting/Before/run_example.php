<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\EventBus;
use Ecotone\Modelling\QueryBus;
use Example\Modelling\Intercepting\Before\ArticleService;
use Example\Modelling\Intercepting\Before\Interceptor\AddExecutorIdService;
use PHPUnit\Framework\Assert;

$rootCatalog = realpath(__DIR__ . "/../../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createNoCache(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        new ArticleService(),
        new AddExecutorIdService()
    ]),
    ["Example\Modelling\Intercepting\Before"]
);

/** @var EventBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);

echo "Sending command without publisher\n";

$commandBus->convertAndSend("article.publish", MediaType::APPLICATION_X_PHP, [
    "content" => "Lorem ipsum"
]);

echo "Sending query for all articles, expecting to have publish id defined \n";

$result = $queryBus->convertAndSend("article.get_all", MediaType::APPLICATION_X_PHP, []);

Assert::assertEquals([
    ["publisherId" => AddExecutorIdService::CURRENTLY_LOGGED_PERSON_ID, "content" => "Lorem ipsum"]
], $result);

echo "Example passed\n";