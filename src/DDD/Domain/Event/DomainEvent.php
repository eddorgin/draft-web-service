<?php

namespace App\DDD\Domain\Event;

use App\DDD\Domain\Entity\EntityId;

/**
 * Interface DomainEvent
 * @package App\DDD\Domain\Event
 */
interface DomainEvent
{
    /**
     * Method return the date, time of the event origin
     * @return \DateTimeImmutable
     */
    public function getOccurredOn(): \DateTimeImmutable;

    /**
     * Method return the entity id
     * @return EntityId
     */
    public function getEntityId(): EntityId;

    /**
     * @return string
     */
    public function getStatus(): string;
}