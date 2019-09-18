<?php


namespace Example\Modelling\Intercepting\Around;

use Ecotone\Messaging\Transaction\Transactional;
use Ecotone\Modelling\Annotation\Aggregate;
use Ecotone\Modelling\Annotation\AggregateIdentifier;
use Ecotone\Modelling\Annotation\CommandHandler;
use Example\Modelling\Intercepting\Around\IsShopOwnerinterceptor\IsExecutorShopOwner;
use Example\Modelling\Intercepting\Around\IsShopOwnerinterceptor\IsShopOwnerService;
use Example\Modelling\Intercepting\Around\TransactionInterceptor\StartTransaction;

/**
 * Class Shop
 * @package Example\Modelling\Intercepting\Around
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 *
 * @Aggregate()
 * @StartTransaction()
 */
class Shop
{
    /**
     * @var string
     *
     * @AggregateIdentifier()
     */
    private $shopId;
    /**
     * @var string
     */
    private $ownerId;
    /**
     * @var string
     */
    private $title;

    private function __construct(string $shopId, string $ownerId, string $title)
    {
        $this->shopId = $shopId;
        $this->ownerId = $ownerId;
        $this->title = $title;
    }

    /**
     * @param RegisterShop $command
     * @param array $metadata
     * @return Shop
     * @CommandHandler()
     */
    public static function createWith(RegisterShop $command, array $metadata) : self
    {
        $shop = new self($command->getShopId(), $metadata[IsShopOwnerService::EXECUTOR_ID], $command->getTitle());

        echo "Shop created\n";
        return $shop;
    }

    /**
     * @param ChangeTitle $command
     *
     * @IsExecutorShopOwner()
     * @CommandHandler()
     */
    public function changeName(ChangeTitle $command) : void
    {
        $this->title = $command->getTitle();

        echo "Shop name changed\n";
    }

    /**
     * @param string $personId
     * @return bool
     */
    public function isShopOwner(string $personId) : bool
    {
        return $this->ownerId === $personId;
    }
}