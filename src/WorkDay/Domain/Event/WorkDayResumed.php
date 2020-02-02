<?php


namespace App\WorkDay\Domain\Event;


use App\DDD\Domain\Entity\EntityId;
use App\DDD\Domain\Event\DomainEvent;

/**
 * Class WorkDayResumed
 * @package App\WorkDay\Domain\Event
 */
class WorkDayResumed implements DomainEvent
{
    /**
     * @var EntityId
     */
    private $entityId;

    /**
     * @var \DateTimeImmutable
     */
    private $resumedDateTime;

    /**
     * WorkDayResumed constructor.
     * @param EntityId $entityId
     * @param \DateTimeImmutable $resumedDateTime
     */
    public function __construct(EntityId $entityId, \DateTimeImmutable $resumedDateTime)
    {
        $this->entityId = $entityId;
        $this->resumedDateTime = $resumedDateTime;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getOccurredOn(): \DateTimeImmutable
    {
        return $this->resumedDateTime;
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