<?php


namespace App\DDD\Domain\Event;


use App\DDD\Domain\Entity\EntityDto;
use App\DDD\Domain\Entity\EntityId;

class EventDto extends EntityDto
{
    public const ID = 'id';
    public const OCCURED_ON = 'occured_on';
    public const STATUS = 'status';
    public const EVENT_BODY = 'event_body';

    /**
     * @var DomainEvent
     */
    private $loggedEvent;

    /**
     * @var array
     */
    private $externalData;

    /**
     * @param DomainEvent $domainEvent
     * @return $this
     */
    public function fetchFromEntity(DomainEvent $domainEvent)
    {
        $this->loggedEvent = $domainEvent;

        $this->externalData = [
            self::ID => $this->loggedEvent->getEntityId(),
            self::OCCURED_ON => $this->loggedEvent->getOccurredOn(),
            self::STATUS => $this->loggedEvent->getStatus(),
        ];

        return $this;
    }

    /**
     * @param array $externalData
     * @return $this
     * @throws \Exception
     */
    public function fetchFromArray(array $externalData)
    {
        $this->loggedEvent = new LoggedEvent(
            new EntityId($externalData[self::ID]),
            $externalData[self::STATUS],
            $externalData[self::EVENT_BODY],
            $externalData[self::OCCURED_ON]
        );

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFetchedEntity()
    {
        return $this->loggedEvent;
    }

    /**
     * @return array
     */
    public function getFetchedExternalData()
    {
        return $this->externalData;
    }
}