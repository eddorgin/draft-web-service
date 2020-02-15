<?php

namespace App\WorkDay\Domain\Model;

use App\DDD\Domain\Entity\EntityId;
use App\DDD\Domain\Entity\EntityStatus;
use App\DDD\Domain\State\Context;
use App\DDD\Domain\State\State;
use App\WorkDay\Domain\State\FinishedState;
use App\WorkDay\Domain\State\PausedState;
use App\WorkDay\Domain\State\ResumedState;
use App\WorkDay\Domain\State\StartedState;
use DateTimeImmutable;

/**
 * Class WorkDay
 * @package App\WorkDay\Domain\Model
 */
class WorkDay implements Context
{
    public $id;

    /**
     * @var EntityId
     */
    public $entityId;

    /**
     * @var int
     */
    public $timeSpent;

    /**
     * @var DateTimeImmutable
     */
    public $startDateTime;

    /**
     * @var EntityStatus
     */
    public $status;

    /**
     * @var State
     */
    private $state;

    public function __construct(
        EntityId $entityId
    )
    {
        $this->entityId = $entityId;
    }

    /**
     * @return EntityId
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * @return int
     */
    public function getTimeSpent(): int
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
     * @param EntityStatus $status
     */
    public function setStatus(EntityStatus $status): void
    {
        $this->status = $status;
    }

    /**
     * @return $this
     */
    public function startWork()
    {
        $this->transitionTo(new StartedState());
        $this->state->handle();
        return $this;
    }

    /**
     * @return $this
     */
    public function pauseWork()
    {
        $this->transitionTo(new PausedState());
        $this->state->handle();
        return $this;
    }

    /**
     * @return $this
     */
    public function finishWork()
    {
        $this->transitionTo(new FinishedState());
        $this->state->handle();
        return $this;
    }

    public function resumeWork()
    {
        $this->transitionTo(new ResumedState());
        $this->state->handle();
        return $this;
    }

    /**
     * @param int $timeSpent
     */
    public function setTimeSpent(int $timeSpent): void
    {
        $this->timeSpent = $timeSpent;
    }

    /**
     * @param State $state
     * @return Context
     */
    public function transitionTo(State $state): Context
    {
        $this->state = $state;
        $this->state->setContext($this);
        return $this;
    }

    /**
     * @param DateTimeImmutable $startDateTime
     */
    public function setStartDateTime(DateTimeImmutable $startDateTime): void
    {
        $this->startDateTime = $startDateTime;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}