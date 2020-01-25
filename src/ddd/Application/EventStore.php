<?php

interface EventStore
{
    public function set(DomainEvent $domainEvent): bool;
    public function findAllEventsSince($eventId);
}