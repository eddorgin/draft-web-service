<?php

namespace App\WorkDay\Domain\Event;

use App\DDD\Domain\Entity\EntityId;
use App\DDD\Domain\Event\DomainEvent;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\Model\WorkDayStatus;

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
     * @var string
     */
    private $status = WorkDayStatus::STATE_ACTIVE;

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
     * @return \DateTimeImmutable
     */
    public function getOccurredOn(): \DateTimeImmutable
    {
        return $this->startDateTime;
    }

    /**
     * Method return the entity id
     * @return EntityId
     */
    public function getEntityId(): EntityId
    {
        return $this->entityId;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}