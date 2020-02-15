<?php

namespace App\WorkDay\Application;

use App\DDD\Application\ApplicationService;
use App\DDD\Domain\DomainRepository;
use App\WorkDay\Domain\Model\WorkDay;
use Exception;

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
     * @param null $request
     * @return CurrentWorkTimeResponse|mixed
     * @throws Exception
     */
    public function execute($request = null)
    {
        $id = $this->repository->generateId();
        $workDay = new WorkDay($id);
        $workDay->startWork();
        $this->repository->save($workDay);
        $response = new CurrentWorkTimeResponse(
            $workDay->getId(),
            $workDay->getEntityId()->getId(),
            $workDay->getStatus()->toString(),
            $workDay->getTimeSpent(),
            $workDay->getStartDateTime()->format('Y-m-d H:i:s')
        );
        return $response;
    }
}