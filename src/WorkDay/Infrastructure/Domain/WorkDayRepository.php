<?php

namespace App\WorkDay\Infrastructure\Domain;

use App\DDD\Application\Persistence;
use App\DDD\Domain\DomainRepository;
use App\DDD\Domain\Entity\EntityId;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\Model\WorkDayFactory;

/**
 * Class WorkTimeRepository
 */
class WorkDayRepository implements DomainRepository
{
    /**
     * @var Persistence
     */
    private Persistence $persistence;

    /**
     * WorkTimeRepository constructor.
     * @param Persistence $persistence
     */
    public function __construct(Persistence $persistence)
    {
        $this->persistence = $persistence;
    }

    /**
     * @return EntityId
     */
    public function generateId(): EntityId
    {
        return new EntityId($this->persistence->generateId());
    }

    /**
     * @param EntityId $id
     * @return WorkDay
     */
    public function findById(EntityId $id): WorkDay
    {
        try {
            $arrayData = $this->persistence->retrieve($id->getId());
        } catch (\OutOfBoundsException $e) {
            throw new \OutOfBoundsException(sprintf('Post with id %d does not exist', $id->getId()), 0, $e);
        }

        return WorkDayFactory::createEntityFromArray($arrayData);
    }

    /**
     * @param WorkDay $workTime
     * @return bool
     */
    public function save($workTime): bool
    {
        $this->persistence->persist([
            'id' => $workTime->getId()->toInt(),
            'statusId' => $workTime->getStatus()->toInt(),
            'timeSpent' => $workTime->getTimeSpent(),
            'startDateTime' => $workTime->getStartDateTime(),
        ]);
    }
}