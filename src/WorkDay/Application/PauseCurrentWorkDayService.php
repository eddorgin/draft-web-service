<?php

namespace App\WorkDay\Application;

use App\DDD\Application\ApplicationService;
use App\DDD\Domain\DomainRepository;
use App\DDD\Domain\Entity\EntityId;
use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Domain\Model\WorkDayFactory;
use App\WorkDay\Domain\WorkDayDto;

/**
 * Class PauseCurrentWorkTimeService
 * @package App\WorkDay\Application
 */
class PauseCurrentWorkDayService implements ApplicationService
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
     * @param CurrentWorkDayRequest $request
     * @return bool|mixed
     * @throws \Exception
     */
    public function execute($request = null)
    {
        /**
         * @var WorkDay $workDay
         */
        $workDayId = $request->getWorkDayId();
        $workDay = $this->repository->findById(new EntityId($workDayId));
        $workDayDto = new WorkDayDto();

        $workDayDto = $workDayDto->fetchFromEntity($workDay);
        $workDay = WorkDayFactory::recoverEntityFromDto($workDayDto);
        $workDay->pauseWork();

        $this->repository->save($workDay);
        $response = new CurrentWorkDayResponse(
            $workDay->getId(),
            $workDay->getEntityId()->getId(),
            $workDay->getStatus()->toString(),
            $workDay->getTimeSpent(),
            $workDay->getStartDateTime()->format('Y-m-d H:i:s')
        );

        return $response;
    }
}