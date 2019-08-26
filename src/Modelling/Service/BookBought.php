<?php


namespace Example\Modelling\Service;


class BookBought
{
    /**
     * @var string
     */
    private $bookId;

    /**
     * BuyBook constructor.
     * @param string $bookId
     */
    public function __construct(string $bookId)
    {
        $this->bookId = $bookId;
    }
}