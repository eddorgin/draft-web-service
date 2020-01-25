<?php


class WorkTime
{
    /**
     * @var EntityId
     */
    public EntityId $id;

    /**
     * @var \DateTimeImmutable
     */
    public $timeSpent;

    /**
     * @var \DateTimeImmutable
     */
    public $startDateTime;

    /**
     * @var EntityStatus
     */
    public $status;

    public function __construct(
        EntityId $entityId,
        \DateTimeImmutable $startDateTime
    )
    {
        $this->id = $entityId;
        $this->status = WorkTimeStatus::fromString(WorkTimeStatus::STATE_ACTIVE);
        $this->startDateTime = $startDateTime;
        $this->timeSpent = 0;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getTimeSpent(): DateTimeImmutable
    {
        return $this->timeSpent;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getStartDateTime(): DateTimeImmutable
    {
        return $this->startDateTime;
    }

    /**
     * @return EntityStatus
     */
    public function getStatus(): EntityStatus
    {
        return $this->status;
    }

    /**
     * @param EntityId $entityId
     * @return mixed|WorkTime
     * @throws Exception
     */
    public static function startWork(EntityId $entityId)
    {
        $factory = new WorkTimeFactory();
        return $factory->createEntity($entityId);
    }

    /**
     * @param EntityStatus $status
     */
    public function setStatus(EntityStatus $status): void
    {
        $this->status = $status;
    }
}