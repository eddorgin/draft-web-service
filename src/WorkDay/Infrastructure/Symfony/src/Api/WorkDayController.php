<?php

namespace App\Symfony\Api;

use App\WorkDay\Application\CurrentWorkDayRequest;
use App\WorkDay\Application\CurrentWorkDayResponse;
use App\WorkDay\Application\StartCurrentWorkDayService;
use App\WorkDay\Application\ViewCurrentWorkDayService;
use App\WorkDay\Domain\Model\WorkDay;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WorkDayController
 * @package App\WorkDay\Infrastructure\Symfony\src\Api
 */
class WorkDayController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * WorkDayController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(Environment $twig, EntityManagerInterface $entityManager, RequestStack $requestStack)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->requestStack = $requestStack;
    }

    /**
     * Start the current work day
     * @Route("/api/start-workday", name="workday")
     * @param StartCurrentWorkDayService $currentWorkTimeService
     * @return Response
     * @throws \Exception
     */
    public function startWorkDay(StartCurrentWorkDayService $currentWorkTimeService)
    {
        /**
         * @var CurrentWorkDayResponse $workTimeResponse
         */
        $workTimeResponse = $currentWorkTimeService->execute();
        $response = new Response(
            json_encode([
                'id' => $workTimeResponse->getId(),
                'startDateTime' => $workTimeResponse->getStartDateTime(),
                'entityId' => $workTimeResponse->getWorkDayId(),
                'state' => $workTimeResponse->getStatus()
            ])
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Start the current work day
     * @Route("/api/show-workday/{id}", name="show-workday")
     * @param ViewCurrentWorkDayService $currentWorkDayService
     * @return Response
     * @throws \Exception
     */
    public function showWorkDay(ViewCurrentWorkDayService $currentWorkDayService)
    {
        $request = $this->requestStack->getCurrentRequest();
        $id = $request->attributes->get('id');
        $workDayRequest = new CurrentWorkDayRequest($id);

        /**
         * @var CurrentWorkDayResponse $workTimeResponse
         */
        $workTimeResponse = $currentWorkDayService->execute($workDayRequest);
        $response = new Response(
            json_encode([
                'id' => $workTimeResponse->getId(),
                'startDateTime' => $workTimeResponse->getStartDateTime(),
                'entityId' => $workTimeResponse->getWorkDayId(),
                'state' => $workTimeResponse->getStatus()
            ])
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}