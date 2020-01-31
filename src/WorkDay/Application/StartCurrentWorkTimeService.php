<?php

namespace App\WorkDay\Application;

use App\DDD\Application\ApplicationService;
use App\DDD\Domain\DomainRepository;
use App\WorkDay\Application\StartCurrentWorkTimeRequest;
use App\WorkDay\Domain\Event\WorkDayStarted;
use App\WorkDay\Domain\Model\WorkDayFactory;
use App\WorkDay\Domain\WorkDayDto;

/**
 * Class StartCurrentWorkTimeService
 * @package App\WorkDay\Application
 */
class StartCurrentWorkTimeService implements ApplicationService
{
    /**
     * @var DomainRepository
     */
    private $repository;

    /**
     * StartCurrentWorkTimeService constructor.
     * @param DomainRepository $workDayRepository
     */
    public function __construct(DomainRepository $workDayRepository)
    {
        $this->repository = $workDayRepository;
    }

    /**
     * @param StartCurrentWorkTimeRequest $request
     * @return bool|mixed
     */
    public function execute($request)
    {
        $workDayId = $request->getWorkDayId();
        $workDayStatus = $request->getStatus();
        $workDayTimeSpent = $request->getTimeSpent();
        $workDayStartDateTime = $request->getStartDateTime();

        $workDayDto = new WorkDayDto();

        $workDayDto = $workDayDto->fetchEntityFromArray([
            'id' => $workDayId,
            'status' => $workDayStatus,
            'timeSpent' => $workDayTimeSpent,
            'startDateTime' => $workDayStartDateTime
        ]);

        $workDay = WorkDayFactory::recoverEntityFromDto($workDayDto);
        $this->repository->save($workDay);
        return true;
    }
}