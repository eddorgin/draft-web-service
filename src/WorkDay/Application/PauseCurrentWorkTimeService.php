<?php

namespace App\WorkDay\Application;

use App\DDD\Application\ApplicationService;
use App\DDD\Domain\DomainRepository;
use App\DDD\Domain\Entity\EntityId;
use App\WorkDay\Domain\Model\WorkDayFactory;
use App\WorkDay\Domain\WorkDayDto;

/**
 * Class PauseCurrentWorkTimeService
 * @package App\WorkDay\Application
 */
class PauseCurrentWorkTimeService implements ApplicationService
{
    /**
     * @var DomainRepository
     */
    private $repository;

    /**
     * PauseCurrentWorkTimeService constructor.
     * @param DomainRepository $workDayRepository
     */
    public function __construct(DomainRepository $workDayRepository)
    {
        $this->repository = $workDayRepository;
    }

    /**
     * @param null|CurrentWorkTimeRequest $request
     * @return bool|mixed
     */
    public function execute($request = null)
    {
        $workDayId = $request->getWorkDayId();
        $workDay = $this->repository->findById(new EntityId($workDayId));
        $workDayDto = new WorkDayDto();

        $workDayDto = $workDayDto->fetchFromEntity($workDay);
        $workDay = WorkDayFactory::recoverEntityFromDto($workDayDto);

        $this->repository->save($workDay);

        return true;
    }
}