<?php

namespace App\WorkDay\Domain\Model;

use App\DDD\Domain\Entity\EntityDto;
use App\DDD\Domain\Entity\EntityFactory;
use App\WorkDay\Domain\State\FinishedState;
use App\WorkDay\Domain\State\PausedState;
use App\WorkDay\Domain\State\StartedState;
use App\WorkDay\Domain\WorkDayDto;

/**
 * Class WorkDayFactory
 * @package App\WorkDay\Domain\Model
 */
class WorkDayFactory extends EntityFactory
{
    /**
     * @param EntityDto $workDayDto
     * @return mixed
     */
    public static function recoverEntityFromDto(EntityDto $workDayDto)
    {
        /**
         * @var WorkDay $workDay
         */
        $workDay = $workDayDto->getFetchedEntity();
        $status = $workDay->getStatus();

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