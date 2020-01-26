<?php

namespace App\DDD\Domain\Event;

/**
 * Interface DomainEvent
 * @package App\DDD\Domain\Event
 */
interface DomainEvent
{
    public function getOccurredOn();
}