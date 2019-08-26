<?php


namespace Example\Modelling\Service;

/**
 * Class BuyBook
 * @package Ecotone\Modelling\Service
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class BuyBook
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

    /**
     * @return string
     */
    public function getBookId(): string
    {
        return $this->bookId;
    }
}