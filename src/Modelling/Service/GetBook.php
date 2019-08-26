<?php


namespace Example\Modelling\Service;

/**
 * Class GetBook
 * @package Ecotone\Modelling\Service
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class GetBook
{
    /**
     * @var string
     */
    private $bookId;

    /**
     * GetBook constructor.
     * @param string $bookId
     */
    public function __construct(string $bookId)
    {
        $this->bookId = $bookId;
    }
}