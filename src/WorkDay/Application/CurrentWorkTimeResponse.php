<?php


namespace App\WorkDay\Application;

/**
 * Class CurrentWorkTimeResponse
 * @package App\WorkDay\Application
 */
class CurrentWorkTimeResponse
{
    private $id;

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
     * @param $id
     * @param $workDayId
     * @param $status
     * @param $timeSpent
     * @param $startDateTime
     */
    public function __construct($id, $workDayId, $status, $timeSpent, $startDateTime)
    {
        $this->id = $id;
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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}