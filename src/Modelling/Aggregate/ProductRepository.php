<?php


namespace Example\Modelling\Aggregate;

use Ecotone\Modelling\Annotation\AggregateRepository;

/**
 * Class OrderRepository
 * @package Example\Modelling\Aggregate
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @AggregateRepository()
 */
class ProductRepository implements \Ecotone\Modelling\AggregateRepository
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
    public function findBy(string $aggregateClassName, array $identifiers)
    {
        if (!isset($this->orders[$this->getIdentifier($identifiers)])) {
            return null;
        }

        return $this->orders[$this->getIdentifier($identifiers)];
    }

    /**
     * @inheritDoc
     */
    public function findWithLockingBy(string $aggregateClassName, array $identifiers, int $expectedVersion)
    {
        return;
    }

    /**
     * @inheritDoc
     */
    public function save(array $identifiers, $aggregate, array $metadata): void
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