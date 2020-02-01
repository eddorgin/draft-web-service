<?php

namespace App\WorkDay\Domain\Event;

use App\DDD\Domain\Entity\EntityId;
use App\DDD\Domain\Event\DomainEvent;

/**
 * Class WorkDayStarted
 * @package App\WorkDay\Domain\Event
 */
final class WorkDayStarted implements DomainEvent
{
    /**
     * @var EntityId
     */
    private EntityId $entityId;

    /**
     * @var \DateTimeImmutable
     */
    private \DateTimeImmutable $startDateTime;

    /**
     * WorkDayStarted constructor.
     * @param EntityId $entityId
     * @param \DateTimeImmutable $startDateTime
     */
    public function __construct(EntityId $entityId, \DateTimeImmutable $startDateTime)
    {
        $this->entityId = $entityId;
        $this->startDateTime = $startDateTime;
    }

    /**
     *
     */
    public function getOccurredOn()
    {
        return $this->startDateTime;
    }
}