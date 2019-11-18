<?php


namespace Example\Modelling\Aggregate;

use Ecotone\Modelling\Annotation\Repository;
use Ecotone\Modelling\StandardRepository;

/**
 * Class OrderRepository
 * @package Example\Modelling\Aggregate
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @Repository()
 */
class ProductRepository implements StandardRepository
{
    /**
     * @var Product[]
     */
    private $orders = [];

    private function __construct(array $orders)
    {
        $this->orders = $orders;
    }

    public static function createEmpty() : self
    {
        return new self([]);
    }

    /**
     * @inheritDoc
     */
    public function canHandle(string $aggregateClassName): bool
    {
        return $aggregateClassName === Product::class;
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $aggregateClassName, array $identifiers) : ?object
    {
        if (!isset($this->orders[$this->getIdentifier($identifiers)])) {
            return null;
        }

        return $this->orders[$this->getIdentifier($identifiers)];
    }

    /**
     * @inheritDoc
     */
    public function save(array $identifiers, $aggregate, array $metadata, ?int $expectedVersion): void
    {
        $this->orders[$this->getIdentifier($identifiers)] = $aggregate;
    }

    /**
     * @param array $identifiers
     * @return false|string
     */
    private function getIdentifier(array $identifiers)
    {
        return \json_encode($identifiers);
    }
}