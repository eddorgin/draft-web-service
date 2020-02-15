<?php


namespace App\WorkDay\Domain\State;


use App\DDD\Domain\State\State;
use App\WorkDay\Domain\Event\WorkDayPaused;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\Model\WorkDayStatus;
use App\WorkDay\Domain\WorkDayEventPublisher;

/**
 * Class PausedState
 * @package App\WorkDay\Domain\State
 */
class PausedState extends State
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
        $workDay->setTimeSpent($timeSpent);
        $workDay->setStartDateTime($currentDateTime);
        $workDay->setStatus(WorkDayStatus::fromString(WorkDayStatus::STATE_PAUSED));
        $event = new WorkDayPaused($workDay->entityId, $currentDateTime);
        WorkDayEventPublisher::instance()->publish($event);
        $this->context->transitionTo($this);
    }
}