<?php

namespace App\WorkDay\Infrastructure\Application\Test;

use App\DDD\Domain\DomainEventSubscriber;
use App\DDD\Domain\Event\DomainEvent;

/**
 * Class TestSubscriber
 * @package App\WorkDay\Infrastructure\Application\Test
 */
class TestSubscriber implements DomainEventSubscriber
{
    /**
     * @var DomainEvent
     */
    public $domainEvent;

    /**
     * @param DomainEvent $domainEvent
     */
    public function handle(DomainEvent $domainEvent)
    {
        $this->domainEvent = $domainEvent;
    }

    /**
     * @param DomainEvent $domainEvent
     * @return bool
     */
    public function isSubscribedTo(DomainEvent $domainEvent)
    {
        return true;
    }
}