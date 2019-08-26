<?php


namespace Example\Modelling\AggregateWithEventPublishing;

use Ecotone\Modelling\Annotation\AggregateRepository;

/**
 * Class OrderRepository
 * @package Example\Modelling\Aggregate
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @AggregateRepository()
 */
class StorageRepository implements \Ecotone\Modelling\AggregateRepository
{
    /**
     * @var Storage[]
     */
    private $storages = [];

    private function __construct(array $storages)
    {
        $this->storages = $storages;
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
        return $aggregateClassName === Storage::class;
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $aggregateClassName, array $identifiers)
    {
        if (!isset($this->storages[$this->getIdentifier($identifiers)])) {
            return null;
        }

        return $this->storages[$this->getIdentifier($identifiers)];
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
        $this->storages[$this->getIdentifier($identifiers)] = $aggregate;
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