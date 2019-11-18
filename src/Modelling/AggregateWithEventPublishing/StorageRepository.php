<?php


namespace Example\Modelling\AggregateWithEventPublishing;


use Ecotone\Modelling\Annotation\Repository;
use Ecotone\Modelling\StandardRepository;

/**
 * Class OrderRepository
 * @package Example\Modelling\Aggregate
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @Repository()
 */
class StorageRepository implements StandardRepository
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
    public function findBy(string $aggregateClassName, array $identifiers) : ?object
    {
        if (!isset($this->storages[$this->getIdentifier($identifiers)])) {
            return null;
        }

        return $this->storages[$this->getIdentifier($identifiers)];
    }

    /**
     * @inheritDoc
     */
    public function save(array $identifiers, $aggregate, array $metadata, ?int $expectedVersion): void
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