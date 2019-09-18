<?php


namespace Example\Modelling\Intercepting\Around;


class ChangeTitle
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
     * ChangeTitle constructor.
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