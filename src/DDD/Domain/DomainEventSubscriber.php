<?php

namespace App\DDD\Domain;

use App\DDD\Domain\Event\DomainEvent;

/**
 * Interface DomainEventSubscriber
 */
interface DomainEventSubscriber
{
    /**
     * @param DomainEvent $domainEvent
     */
    public function handle(DomainEvent $domainEvent);

    /**
     * @param DomainEvent $domainEvent
     * @return bool
     */
    public function isSubscribedTo(DomainEvent $domainEvent);
}