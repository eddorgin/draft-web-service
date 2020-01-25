<?php

/**
 * Class WorkTimeRepository
 */
class WorkTimeRepository implements DomainRepository
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

    public function findById(EntityId $id): WorkTime
    {
        try {
            $arrayData = $this->persistence->retrieve($id->getId());
        } catch (OutOfBoundsException $e) {
            throw new OutOfBoundsException(sprintf('Post with id %d does not exist', $id->getId()), 0, $e);
        }

        return WorkTime::fromState($arrayData);
    }

    /**
     * @param WorkTime $workTime
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