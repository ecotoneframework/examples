<?php


namespace Example\Modelling\Intercepting\Around;

/**
 * Class RegisterShop
 * @package Example\Modelling\Intercepting\Around
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class RegisterShop
{
    /**
     * @var string
     */
    private $shopId;
    /**
     * @var string
     */
    private $title;

    /**
     * RegisterShop constructor.
     * @param string $shopId
     * @param string $title
     */
    public function __construct(string $shopId, string $title)
    {
        $this->shopId = $shopId;
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getShopId(): string
    {
        return $this->shopId;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}