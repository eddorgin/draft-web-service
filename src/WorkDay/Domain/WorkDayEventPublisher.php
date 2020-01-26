<?php

namespace App\WorkDay\Domain;

use App\DDD\Domain\DomainEventPublisher;
use App\DDD\Domain\DomainEventSubscriber;
use App\DDD\Domain\Event\DomainEvent;

/**
 * Class WorkDayEventPublisher
 * @package App\WorkDay\Domain
 */
class WorkDayEventPublisher implements DomainEventPublisher
{
    /**
     * @var DomainEventSubscriber[]
     */
    private $subscribers;

    /**
     * @var DomainEventPublisher
     */
    private static $instance = null;

    /**
     * @var int
     */
    private $id = 0;

    /**
     * @return DomainEventPublisher
     */
    public static function instance()
    {
        if (null === static::$instance)
        {
            static::$instance = new self();
        }

        return static::$instance;
    }

    /**
     * WorkDayEventPublisher constructor.
     */
    private function __construct()
    {
        $this->subscribers = [];
    }

    public function __clone()
    {
        throw new \BadMethodCallException('Clone is not supported');
    }

    /**
     * @param DomainEventSubscriber $domainEventSubscriber
     * @return int|mixed
     */
    public function subscribe($domainEventSubscriber)
    {
        $id = $this->id;
        $this->subscribers[$id] = $domainEventSubscriber;
        $this->id++;

        return $id;
    }

    /**
     * @param $id
     * @return DomainEventSubscriber|mixed|null
     */
    public function getById($id)
    {
        return isset($this->subscribers[$id]) ? $this->subscribers[$id] : null;
    }

    /**
     * @param $id
     * @return mixed|void
     */
    public function unsubscribe($id)
    {
        unset($this->subscribers[$id]);
    }

    /**
     * @param DomainEvent $domainEvent
     * @return mixed|void
     */
    public function publish($domainEvent)
    {
        foreach ($this->subscribers as $aSubscriber) {
            if ($aSubscriber->isSubscribedTo($domainEvent)) {
                $aSubscriber->handle($domainEvent);
            }
        }
    }
}