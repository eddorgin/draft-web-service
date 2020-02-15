<?php

namespace App\WorkDay\Infrastructure\Domain;

use App\DDD\Application\Persistence;
use App\DDD\Domain\DomainRepository;
use App\DDD\Domain\Entity\EntityId;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\Model\WorkDayFactory;
use App\WorkDay\Domain\WorkDayDto;

/**
 * Class WorkDayRepository
 * @package App\WorkDay\Infrastructure\Domain
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
     * @throws \Exception
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
            $entity = $this->persistence->retrieve($id->getId());
        } catch (\OutOfBoundsException $e) {
            throw new \OutOfBoundsException(sprintf('Post with id %d does not exist', $id->getId()), 0, $e);
        }

        $workDayDto = new WorkDayDto();
        $workDayDto = $workDayDto->fetchFromEntity($entity);
        return WorkDayFactory::recoverEntityFromDto($workDayDto);
    }

    /**
     * @param WorkDay $workDay
     * @return bool
     */
    public function save($workDay): bool
    {
        $this->persistence->persist($workDay);

        return true;
    }
}