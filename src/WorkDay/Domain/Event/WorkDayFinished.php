<?php


namespace App\WorkDay\Domain\Event;


use App\DDD\Domain\Entity\EntityId;
use App\DDD\Domain\Event\DomainEvent;

/**
 * Class WorkDayFinished
 * @package App\WorkDay\Domain\Event
 */
class WorkDayFinished implements DomainEvent
{
    /**
     * @var EntityId
     */
    private $entityId;

    /**
     * @var \DateTimeImmutable
     */
    private $finishedDateTime;

    /**
     * WorkDayFinished constructor.
     * @param EntityId $entityId
     * @param \DateTimeImmutable $finishedDateTime
     */
    public function __construct(EntityId $entityId, \DateTimeImmutable $finishedDateTime)
    {
        $this->entityId = $entityId;
        $this->finishedDateTime = $finishedDateTime;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getOccurredOn(): \DateTimeImmutable
    {
        return $this->finishedDateTime;
    }

    /**
     * Method return the entity id
     * @return EntityId
     */
    public function getEntityId(): EntityId
    {
        return $this->entityId;
    }
}