<?php


namespace App\DDD\Domain\Event;


use App\DDD\Domain\DomainEventSubscriber;
use App\DDD\Infrastructure\Logging\LoggerAdapter;

/**
 * Class LoggerDomainEventSubscriber
 * @package App\DDD\Domain\Event
 */
class LoggerDomainEventSubscriber implements DomainEventSubscriber
{
    /**
     * @var LoggerAdapter
     */
    private $loggerAdapter;

    /**
     * LoggerDomainEventSubscriber constructor.
     * @param LoggerAdapter $loggerAdapter
     */
    public function __construct(LoggerAdapter $loggerAdapter)
    {
        $this->loggerAdapter = $loggerAdapter;
    }

    /**
     * @param DomainEvent $domainEvent
     * @return bool
     */
    public function handle(DomainEvent $domainEvent)
    {
        return $this->loggerAdapter->log($domainEvent);
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