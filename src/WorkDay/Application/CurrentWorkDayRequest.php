<?php

namespace App\WorkDay\Application;

/**
 * Class CurrentWorkDayRequest
 * @package App\WorkDay\Application
 */
class CurrentWorkDayRequest
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