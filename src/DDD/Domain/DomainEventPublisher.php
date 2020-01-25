<?php

namespace App\DDD\Domain;

use App\DDD\Domain\Event\DomainEvent;

/**
 * Interface DomainEventPublisher
 */
interface DomainEventPublisher
{
    /**
     * @param DomainEventSubscriber $domainEventSubscriber
     * @return mixed
     */
    public function subscribe(DomainEventSubscriber $domainEventSubscriber);

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param $id
     * @return mixed
     */
    public function unsubscribe($id);

    /**
     * @param DomainEvent $domainEvent
     * @return mixed
     */
    public function publish(DomainEvent $domainEvent);
}