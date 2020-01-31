<?php

namespace App\WorkDay\Application;

/**
 * Class StartCurrentWorkTimeRequest
 */
class StartCurrentWorkTimeRequest
{
    /**
     * @var int
     */
    private $workDayId;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $timeSpent;

    /**
     * @var string
     */
    private $startDateTime;

    /**
     * StartCurrentWorkTimeRequest constructor.
     * @param $status
     * @param $timeSpent
     * @param $startDateTime
     */
    public function __construct($workDayId, $status, $timeSpent, $startDateTime)
    {
        $this->workDayId = $workDayId;
        $this->status = $status;
        $this->timeSpent = $timeSpent;
        $this->startDateTime = $startDateTime;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getTimeSpent()
    {
        return $this->timeSpent;
    }

    /**
     * @return string
     */
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

    /**
     * @return int
     */
    public function getWorkDayId()
    {
        return $this->workDayId;
    }
}