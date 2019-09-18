<?php


namespace Example\Modelling\Intercepting\Around;

use Ecotone\Modelling\Annotation\AggregateRepository;

/**
 * Class OrderRepository
 * @package Example\Modelling\Aggregate
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @AggregateRepository()
 */
class ShopRepository implements \Ecotone\Modelling\AggregateRepository
{
    /**
     * @var Shop[]
     */
    private $shops = [];

    private function __construct(array $shops)
    {
        $this->shops = $shops;
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
        return $aggregateClassName === Shop::class;
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $aggregateClassName, array $identifiers)
    {
        if (!isset($this->shops[$this->getIdentifier($identifiers)])) {
            return null;
        }

        return $this->shops[$this->getIdentifier($identifiers)];
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
        $this->shops[$this->getIdentifier($identifiers)] = $aggregate;
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