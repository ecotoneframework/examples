<?php


namespace Example\Modelling\Intercepting\Around;

use Ecotone\Modelling\Annotation\Repository;
use Ecotone\Modelling\StandardRepository;

/**
 * Class OrderRepository
 * @package Example\Modelling\Aggregate
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @Repository()
 */
class ShopRepository implements StandardRepository
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
    public function findBy(string $aggregateClassName, array $identifiers) : ?object
    {
        if (!isset($this->shops[$this->getIdentifier($identifiers)])) {
            return null;
        }

        return $this->shops[$this->getIdentifier($identifiers)];
    }

    /**
     * @inheritDoc
     */
    public function save(array $identifiers, $aggregate, array $metadata, ?int $expectedVersion): void
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