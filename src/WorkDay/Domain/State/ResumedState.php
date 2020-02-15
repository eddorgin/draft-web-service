<?php


namespace App\WorkDay\Domain\State;


use App\DDD\Domain\State\State;
use App\WorkDay\Domain\Event\WorkDayResumed;
use App\WorkDay\Domain\Event\WorkDayStarted;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\Model\WorkDayStatus;
use App\WorkDay\Domain\WorkDayEventPublisher;

class ResumedState extends State
{

    public function handle()
    {
        /**
         * @var WorkDay $workDay
         */
        $workDay = $this->context;
        $currentDateTime = new \DateTimeImmutable();
        $startDateTime = $workDay->startDateTime->getTimestamp();
        $timeSpent = $currentDateTime->getTimestamp() - $startDateTime;
        $workDay->setTimeSpent($timeSpent);
        $workDay->setStartDateTime($currentDateTime);
        $workDay->setStatus(WorkDayStatus::fromString(WorkDayStatus::STATE_ACTIVE));
        $event = new WorkDayResumed($workDay->entityId, $workDay->startDateTime);
        WorkDayEventPublisher::instance()->publish($event);
        $this->context->transitionTo($this);
    }
}