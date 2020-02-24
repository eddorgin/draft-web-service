<?php

namespace App\DDD\Infrastructure\Logging;

use App\DDD\Domain\Event\DomainEvent;

/**
 * Class LoggerAdapter
 * @package App\DDD\Infrastructure\Logging
 */
abstract class LoggerAdapter
{
    protected $logger;

    /**
     * @param DomainEvent $domainEvent
     * @return bool
     */
    abstract public function log(DomainEvent $domainEvent): bool;
}