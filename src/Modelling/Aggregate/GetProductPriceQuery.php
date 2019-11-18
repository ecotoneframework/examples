<?php


namespace Example\Modelling\Aggregate;


class GetProductPriceQuery
{
    /**
     * @var string
     */
    private $productId;

    /**
     * GetProductPrice constructor.
     * @param string $productId
     */
    public function __construct(string $productId)
    {
        $this->productId = $productId;
    }
}