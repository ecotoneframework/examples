<?php


namespace Example\Modelling\Aggregate;

use Ecotone\Modelling\Annotation\Aggregate;
use Ecotone\Modelling\Annotation\AggregateIdentifier;
use Ecotone\Modelling\Annotation\CommandHandler;
use Ecotone\Modelling\Annotation\QueryHandler;

/**
 * Class Order
 * @package Example\Modelling\Aggregate
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
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

    /**
     * Order constructor.
     * @param string $orderId
     * @param string $name
     * @param int $priceAmount
     */
    private function __construct(string $orderId, string $name, int $priceAmount)
    {
        $this->productId = $orderId;
        $this->name = $name;
        $this->priceAmount = $priceAmount;
    }

    /**
     * @param RegisterProduct $command
     * @return Product
     * @CommandHandler()
     */
    public static function register(RegisterProduct $command) : self
    {
        echo "Received RegisterProduct command\n";

        return new self(
            $command->getOrderId(),
            $command->getName(),
            $command->getPriceAmount()
        );
    }

    /**
     * @param GetProductPrice $query
     * @return int
     * @QueryHandler()
     */
    public function getPrice(GetProductPrice $query) : int
    {
        echo "Received GetProductPrice query\n";

        return $this->priceAmount;
    }
}