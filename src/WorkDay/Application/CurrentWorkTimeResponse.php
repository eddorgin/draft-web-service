<?php


namespace App\WorkDay\Application;

/**
 * Class CurrentWorkTimeResponse
 * @package App\WorkDay\Application
 */
class CurrentWorkTimeResponse
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
     * @var int
     */
    private $timeSpent;

    /**
     * @var string
     */
    private $startDateTime;

    /**
     * CurrentWorkTimeResponse constructor.
     * @param $workDayId
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
     * @return int
     */
    public function getWorkDayId()
    {
        return $this->workDayId;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getTimeSpent(): int
    {
        return $this->timeSpent;
    }

    /**
     * @return string
     */
    public function getStartDateTime(): string
    {
        return $this->startDateTime;
    }
}