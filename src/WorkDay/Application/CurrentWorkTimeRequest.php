<?php

namespace App\WorkDay\Application;

/**
 * Class CurrentWorkTimeRequest
 * @package App\WorkDay\Application
 */
class CurrentWorkTimeRequest
{
    /**
     * @var int
     */
    private $workDayId;

    /**
     * PauseCurrentWorkTimeRequest constructor.
     * @param $workDayId
     */
    public function __construct($workDayId)
    {
        $this->workDayId = $workDayId;
    }

    /**
     * @return int
     */
    public function getWorkDayId()
    {
        return $this->workDayId;
    }
}