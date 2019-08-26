<?php


namespace Example\Modelling\AggregateWithEventPublishing;

use Ecotone\Modelling\Annotation\Aggregate;
use Ecotone\Modelling\Annotation\AggregateIdentifier;
use Ecotone\Modelling\Annotation\CommandHandler;
use Ecotone\Modelling\WithAggregateEvents;
use Example\Modelling\AggregateWithEventPublishing\Command\OpenStorage;
use Example\Modelling\AggregateWithEventPublishing\Command\RegisterBox;
use Example\Modelling\AggregateWithEventPublishing\Event\BoxWasRegistered;
use Example\Modelling\AggregateWithEventPublishing\Event\StorageRanOutOfCapacity;
use Example\Modelling\AggregateWithEventPublishing\Event\StorageWasOpened;

/**
 * Class Storage
 * @package Example\Modelling\AggregateWithEventPublishing
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 * @Aggregate()
 */
class Storage
{
    use WithAggregateEvents;

    /**
     * @AggregateIdentifier()
     * @var string
     */
    private $storageId;
    /**
     * @var Box[]
     */
    private $registeredBoxes = [];
    /**
     * @var int
     */
    private $availableCapacity;

    /**
     * Storage constructor.
     * @param string $storageId
     * @param int $availableCapacity
     */
    private function __construct(string $storageId, int $availableCapacity)
    {
        $this->storageId = $storageId;
        $this->availableCapacity = $availableCapacity;

        $this->record(new StorageWasOpened($storageId));
    }

    /**
     * @CommandHandler()
     * @param OpenStorage $command
     * @return Storage
     */
    public static function openNewStorage(OpenStorage $command) : self
    {
        return new self($command->getStorageId(), $command->getCapacity());
    }

    /**
     * @CommandHandler()
     * @param RegisterBox $command
     */
    public function registerBox(RegisterBox $command) : void
    {
        if ($this->hasBoxRegistered($command)) {
            return;
        }

        if ($this->currentlyTakenCapacity() >= $this->availableCapacity) {
            $this->record(new StorageRanOutOfCapacity($this->storageId));

            return;
        }

        $this->registeredBoxes[] = $command->getBox();
        $this->record(new BoxWasRegistered($this->storageId, $command->getBox()->getBoxId()));
    }

    /**
     * @param RegisterBox $command
     * @return bool
     */
    private function hasBoxRegistered(RegisterBox $command): bool
    {
        foreach ($this->registeredBoxes as $registeredBox) {
            if ($registeredBox->isSameAs($command->getBox())) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return int
     */
    private function currentlyTakenCapacity() : int
    {
        return count($this->registeredBoxes);
    }
}