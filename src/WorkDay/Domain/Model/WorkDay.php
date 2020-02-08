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

/**
 * Class WorkDay
 * @package App\WorkDay\Domain\Model
 */
class WorkDay implements Context
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

    /**
     * @var State
     */
    private $state;

    public function __construct(
        EntityId $entityId
    )
    {
        $this->id = $entityId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id->getId();
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getTimeSpent(): \DateTimeImmutable
    {
        return $this->timeSpent;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getStartDateTime(): \DateTimeImmutable
    {
        return $this->startDateTime;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status->toString();
    }

    /**
     * @param EntityStatus $status
     */
    public function setStatus(EntityStatus $status): void
    {
        $this->status = $status;
    }

    /**
     * @param EntityId $entityId
     * @return mixed|WorkDay
     * @throws \Exception
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
     * @param \DateTimeImmutable $startDateTime
     */
    public function setStartDateTime(\DateTimeImmutable $startDateTime): void
    {
        $this->startDateTime = $startDateTime;
    }
}