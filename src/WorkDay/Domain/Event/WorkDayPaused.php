<?php


namespace App\WorkDay\Domain\Event;


use App\DDD\Domain\Entity\EntityId;
use App\DDD\Domain\Event\DomainEvent;

/**
 * Class WorkDayPaused
 * @package App\WorkDay\Domain\Event
 */
class WorkDayPaused implements DomainEvent
{
    /**
     * @var EntityId
     */
    private $entityId;

    /**
     * @var \DateTimeImmutable
     */
    private $pausedDateTime;

    /**
     * WorkDayPaused constructor.
     * @param EntityId $entityId
     * @param \DateTimeImmutable $pausedDateTime
     */
    public function __construct(EntityId $entityId, \DateTimeImmutable $pausedDateTime)
    {
        $this->entityId = $entityId;
        $this->pausedDateTime = $pausedDateTime;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getOccurredOn(): \DateTimeImmutable
    {
        return $this->pausedDateTime;
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