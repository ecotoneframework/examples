<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Messaging\Config\ApplicationConfiguration;
use Ecotone\Messaging\Conversion\MediaType;
use Ecotone\Modelling\QueryBus;
use Example\Modelling\Intercepting\After\ArticleQueryService;
use Example\Modelling\Intercepting\After\Interceptor\TransformAllQueryServicesToResult;
use Example\Modelling\Intercepting\Before\Interceptor\AddExecutorIdService;
use PHPUnit\Framework\Assert;

$rootCatalog = realpath(__DIR__ . "/../../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createWithConfiguration(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        new ArticleQueryService(),
        new TransformAllQueryServicesToResult()
    ]),
    ApplicationConfiguration::createWithDefaults()
        ->withNamespaces(["Example\Modelling\Intercepting\After"])
);

// Begin test scenario

/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);

echo "Sending query\n";

$result = $queryBus->convertAndSend("article.is_published", MediaType::APPLICATION_X_PHP, []);

Assert::assertEquals([
    "result" => true
], $result);

echo "Example passed\n";