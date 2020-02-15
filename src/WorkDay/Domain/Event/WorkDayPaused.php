<?php


namespace App\WorkDay\Domain\Event;


use App\DDD\Domain\Entity\EntityId;
use App\DDD\Domain\Event\DomainEvent;
use App\WorkDay\Domain\Model\WorkDayStatus;

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
     * @var string
     */
    private $status = WorkDayStatus::STATE_PAUSED;


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

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}