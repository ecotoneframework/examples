<?php


namespace Example\Modelling\Aggregate;

use Ecotone\Modelling\Annotation\Aggregate;
use Ecotone\Modelling\Annotation\AggregateIdentifier;
use Ecotone\Modelling\Annotation\CommandHandler;
use Ecotone\Modelling\Annotation\QueryHandler;

/**
 * @Aggregate()
 */
class Product
{
    /**
     * @var string
     * @AggregateIdentifier()
     */
    private $productId;
    /**
     * @var string
     */
    private $name;
    /**
     * @var integer
     */
    private $priceAmount;

    private function __construct(string $orderId, string $name, int $priceAmount)
    {
        $this->productId = $orderId;
        $this->name = $name;
        $this->priceAmount = $priceAmount;
    }

    /**
     * @CommandHandler()
     */
    public static function register(RegisterProductCommand $command) : self
    {
        echo "Received RegisterProduct command\n";

        return new self(
            $command->getOrderId(),
            $command->getName(),
            $command->getPriceAmount()
        );
    }

    /**
     * @param GetProductPriceQuery $query
     * @return int
     * @QueryHandler()
     */
    public function getPrice(GetProductPriceQuery $query) : int
    {
        echo "Received GetProductPrice query\n";

        return $this->priceAmount;
    }
}