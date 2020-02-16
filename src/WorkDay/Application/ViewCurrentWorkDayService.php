<?php


namespace App\WorkDay\Application;


use App\DDD\Application\ApplicationService;
use App\DDD\Domain\DomainRepository;
use App\DDD\Domain\Entity\EntityId;
use App\WorkDay\Domain\Model\WorkDay;
use Exception;

/**
 * Class ViewCurrentWorkDayService
 * @package App\WorkDay\Application
 */
class ViewCurrentWorkDayService implements ApplicationService
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
     * @param CurrentWorkDayRequest $request
     * @return CurrentWorkDayResponse|mixed
     * @throws Exception
     */
    public function execute($request = null)
    {
        $workDayId = $request->getWorkDayId();
        $workDay = $this->repository->findById(new EntityId($workDayId));
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