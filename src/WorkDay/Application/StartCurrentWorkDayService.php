<?php

namespace App\WorkDay\Application;

use App\DDD\Application\ApplicationService;
use App\DDD\Domain\DomainRepository;
use App\WorkDay\Domain\Model\WorkDay;
use Exception;

/**
 * Class StartCurrentWorkDayService
 * @package App\WorkDay\Application
 */
class StartCurrentWorkDayService implements ApplicationService
{
    /**
     * @var DomainRepository
     */
    private $repository;

    /**
     * StartCurrentWorkDayService constructor.
     * @param DomainRepository $workDayRepository
     */
    public function __construct(DomainRepository $workDayRepository)
    {
        $this->repository = $workDayRepository;
    }

    /**
     * @param null $request
     * @return CurrentWorkDayResponse|mixed
     * @throws Exception
     */
    public function execute($request = null)
    {
        $id = $this->repository->generateId();
        $workDay = new WorkDay($id);
        $workDay->startWork();
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