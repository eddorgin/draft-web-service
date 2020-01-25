<?php

namespace App\DDD\Application;

use App\DDD\Domain\Event\DomainEvent;

/**
 * Interface EventStore
 * @package App\DDD\Application
 */
interface EventStore
{
    /**
     * @param DomainEvent $domainEvent
     * @return bool
     */
    public function set(DomainEvent $domainEvent): bool;

    /**
     * @param $eventId
     * @return mixed
     */
    public function findAllEventsSince($eventId);
}