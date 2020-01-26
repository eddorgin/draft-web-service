<?php

namespace App\WorkDay\Domain\Model;

use App\DDD\Domain\Entity\EntityFactory;
use App\WorkDay\Domain\State\FinishedState;
use App\WorkDay\Domain\State\PausedState;
use App\WorkDay\Domain\State\StartedState;

/**
 * Class WorkDayFactory
 * @package App\WorkDay\Domain\Model
 */
class WorkDayFactory extends EntityFactory
{
    /**
     * @param array $data
     * @return WorkDay
     */
    public static function createEntityFromArray(array $data)
    {
        /**
         * @var WorkDayStatus $status
         */
        $id = $data['id'];
        $workDay = new WorkDay($id);
        $statusId = $data['statusId'];
        $status = WorkDayStatus::fromInt($statusId);
        $workDay->setTimeSpent($data['timeSpent']);
        $workDay->setStatus($status);
        $workDay->setStartDateTime($data['startDateTime']);

        switch ($status->toString())
        {
            case WorkDayStatus::STATE_ACTIVE:
                $workDay->transitionTo(new StartedState());
                break;
            case WorkDayStatus::STATE_PAUSED:
                $workDay->transitionTo(new PausedState());
                break;
            case WorkDayStatus::STATE_FINISHED:
                $workDay->transitionTo(new FinishedState());
                break;
            default:
                throw new \InvalidArgumentException('Wrong state');
        }

        return $workDay;
    }
}