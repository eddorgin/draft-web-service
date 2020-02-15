<?php


namespace App\WorkDay\Domain;


use App\DDD\Domain\Entity\EntityDto;
use App\DDD\Domain\Entity\EntityId;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\Model\WorkDayStatus;
use Webmozart\Assert\Assert;

/**
 * Class WorkDayDto
 * @package App\WorkDay\Domain
 */
final class WorkDayDto extends EntityDto
{
    public const ID = 'id';
    public const TIME_SPENT = 'timeSpent';
    public const STATUS = 'status';
    public const START_DATE_TIME = 'startDateTime';

    /**
     * @var WorkDay
     */
    private $workDay;

    /**
     * @var array
     */
    private $externalData;

    /**
     * @param WorkDay $workDay
     * @return $this
     */
    public function fetchFromEntity(WorkDay $workDay)
    {
        $this->workDay = $workDay;

        $this->externalData = [
            self::ID => $this->workDay->getEntityId(),
            self::TIME_SPENT => $this->workDay->getTimeSpent(),
            self::STATUS => $this->workDay->getStatus(),
            self::START_DATE_TIME => $this->workDay->getStartDateTime()
        ];

        return $this;
    }

    /**
     * @param array $externalData
     * @return $this
     * @throws \Exception
     */
    public function fetchFromArray(array $externalData)
    {
        $workDay = new WorkDay(new EntityId($externalData[self::ID]));
        $workDay->setStatus(WorkDayStatus::fromString($externalData[self::STATUS]));
        $workDay->setTimeSpent($externalData[self::TIME_SPENT]);
        $workDay->setStartDateTime($externalData[self::START_DATE_TIME]);

        $this->workDay = $workDay;

        return $this;
    }

    /**
     * @return WorkDay
     */
    public function getFetchedEntity()
    {
        return $this->workDay;
    }

    /**
     * @return array
     */
    public function getFetchedExternalData()
    {
        return $this->externalData;
    }
}