<?php

namespace App\WorkDay\Domain\State;

use App\DDD\Domain\State\Context;
use App\DDD\Domain\State\State;
use App\WorkDay\Domain\Event\WorkDayStarted;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\Model\WorkDayStatus;
use App\WorkDay\Domain\WorkDayEventPublisher;

/**
 * Class StartedState
 * @package App\WorkDay\Domain\State
 */
class StartedState extends State
{
    /**
     * @throws \Exception
     */
    public function handle()
    {
        /**
         * @var WorkDay $workDay
         */
        $workDay = $this->context;
        $workDay->setStatus(WorkDayStatus::fromString(WorkDayStatus::STATE_ACTIVE));
        $workDay->setStartDateTime(new \DateTimeImmutable());
        $workDay->setTimeSpent(0);
        $event = new WorkDayStarted($workDay->entityId, $workDay->startDateTime);
        WorkDayEventPublisher::instance()->publish($event);
        $this->context->transitionTo($this);
    }
}