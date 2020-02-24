<?php

namespace App\DDD\Infrastructure\Logging;

use App\DDD\Domain\Event\DomainEvent;
use App\DDD\Domain\Event\EventDto;
use Monolog\Handler\AbstractHandler;
use Monolog\Logger;

/**
 * Class MonologLoggerAdapter
 * @package App\DDD\Infrastructure\Logging
 */
final class MonologLoggerAdapter extends LoggerAdapter
{
    public const WORK_DAY_EVENT = 'work day event';

    /**
     * MonologLoggerAdapter constructor.
     * @param AbstractHandler $handler
     * @param $logger
     */
    public function __construct(AbstractHandler $handler)
    {
        $this->logger = new Logger('work_day');
        $this->logger->pushHandler($handler);
    }

    /**
     * @param DomainEvent $domainEvent
     * @return bool
     */
    public function log(DomainEvent $domainEvent): bool
    {
        $eventDto = new EventDto();
        $eventDto->fetchFromEntity($domainEvent);
        $this->logger->info(self::WORK_DAY_EVENT, $eventDto->getFetchedExternalData());

        return true;
    }
}