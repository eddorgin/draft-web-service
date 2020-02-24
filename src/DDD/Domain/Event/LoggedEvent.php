<?php


namespace App\DDD\Domain\Event;


use App\DDD\Domain\Entity\EntityId;
use DateTimeImmutable;

/**
 * Class LoggedEvent
 * @package App\DDD\Domain\Event
 */
class LoggedEvent implements DomainEvent
{
    public $id;

    /**
     * @var EntityId
     */
    public $entityId;

    /**
     * @var mixed
     */
    public $eventBody;

    /**
     * @var DateTimeImmutable
     */
    public $occuredOn;

    /**
     * @var string
     */
    public $status;

    /**
     * LoggedEvent constructor.
     * @param EntityId $entityId
     * @param $eventBody
     * @param $occuredOn
     */
    public function __construct(
        EntityId $entityId,
        $status,
        $eventBody,
        $occuredOn
    )
    {
        $this->entityId = $entityId;
        $this->status = $status;
        $this->eventBody = $eventBody;
        $this->occuredOn = $occuredOn;
    }

    /**
     * @return EntityId
     */
    public function getEntityId(): EntityId
    {
        return $this->entityId;
    }

    /**
     * @return mixed
     */
    public function getEventBody()
    {
        return $this->eventBody;
    }

    /**
     * Method return the date, time of the event origin
     * @return \DateTimeImmutable
     */
    public function getOccurredOn(): \DateTimeImmutable
    {
        return $this->occuredOn;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}