<?php


namespace App\WorkDay\Domain\State;


use App\DDD\Domain\State\State;
use App\WorkDay\Domain\Event\WorkDayFinished;
use App\WorkDay\Domain\Event\WorkDayPaused;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\Model\WorkDayStatus;
use App\WorkDay\Domain\WorkDayEventPublisher;

/**
 * Class FinishedState
 * @package App\WorkDay\Domain\State
 */
class FinishedState extends State
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
        $currentDateTime = new \DateTimeImmutable();
        $startDateTime = $workDay->startDateTime->getTimestamp();
        $timeSpent = $currentDateTime->getTimestamp() - $startDateTime;
        $workDay->setTimeSpent($workDay->timeSpent + $timeSpent);
        $workDay->setStatus(WorkDayStatus::fromString(WorkDayStatus::STATE_FINISHED));
        $event = new WorkDayFinished($workDay->id, $currentDateTime);
        WorkDayEventPublisher::instance()->publish($event);
        $this->context->transitionTo($this);
    }
}