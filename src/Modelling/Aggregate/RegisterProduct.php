<?php


namespace Example\Modelling\Aggregate;

use Ecotone\Modelling\Annotation\AggregateIdentifier;

/**
 * Class CreateOrder
 * @package Example\Modelling\Aggregate
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class RegisterProduct
{
    /**
     * @var string
     * @AggregateIdentifier()
     */
    private $orderId;
    /**
     * @var string
     */
    private $name;
    /**
     * @var integer
     */
    private $priceAmount;

    /**
     * RegisterProduct constructor.
     * @param string $orderId
     * @param string $name
     * @param int $priceAmount
     */
    public function __construct(string $orderId, string $name, int $priceAmount)
    {
        $this->orderId = $orderId;
        $this->name = $name;
        $this->priceAmount = $priceAmount;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPriceAmount(): int
    {
        return $this->priceAmount;
    }
}