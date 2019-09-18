<?php

use Ecotone\Lite\EcotoneLiteConfiguration;
use Ecotone\Lite\InMemoryPSRContainer;
use Ecotone\Modelling\CommandBus;
use Ecotone\Modelling\EventBus;
use Ecotone\Modelling\QueryBus;
use Example\Modelling\Intercepting\Around\ChangeTitle;
use Example\Modelling\Intercepting\Around\IsShopOwnerInterceptor\IsShopOwnerService;
use Example\Modelling\Intercepting\Around\RegisterShop;
use Example\Modelling\Intercepting\Around\ShopRepository;
use Example\Modelling\Intercepting\Around\TransactionInterceptor\TransactionService;

$rootCatalog = realpath(__DIR__ . "/../../../../");
require $rootCatalog . "/vendor/autoload.php";

$messagingSystem = EcotoneLiteConfiguration::createNoCache(
    $rootCatalog,
    InMemoryPSRContainer::createFromObjects([
        ShopRepository::createEmpty(),
        new TransactionService(),
        new IsShopOwnerService()
    ]),
    ["Example\Modelling\Intercepting\Around"]
);

/** @var EventBus $commandBus */
$commandBus = $messagingSystem->getGatewayByName(CommandBus::class);
/** @var QueryBus $queryBus */
$queryBus = $messagingSystem->getGatewayByName(QueryBus::class);

echo "Registering new shop\n";

$executorId = 100;
$commandBus->sendWithMetadata(new RegisterShop(1, "Chicken Shop"), [IsShopOwnerService::EXECUTOR_ID => $executorId]);

echo "Changing title of shop\n";
$commandBus->sendWithMetadata(new ChangeTitle(1, "Meat Shop"), [IsShopOwnerService::EXECUTOR_ID => $executorId]);

echo "Example passed\n";