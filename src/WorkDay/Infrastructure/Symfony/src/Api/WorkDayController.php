<?php

namespace App\Symfony\Api;

use App\WorkDay\Application\CurrentWorkTimeResponse;
use App\WorkDay\Application\StartCurrentWorkTimeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * WorkDayController constructor.
     * @param Environment $twig
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    /**
     * Show the current work day
     * @Route("/api/start-workday", name="workday")
     * @param StartCurrentWorkTimeService $currentWorkTimeService
     * @return Response
     * @throws \Exception
     */
    public function startWorkDay(StartCurrentWorkTimeService $currentWorkTimeService)
    {
        /**
         * @var CurrentWorkTimeResponse $workTimeResponse
         */
        $workTimeResponse = $currentWorkTimeService->execute();
        $response = new Response(
            json_encode([
                'startDateTime' => $workTimeResponse->getStartDateTime(),
                'id' => $workTimeResponse->getWorkDayId(),
                'state' => $workTimeResponse->getStatus()
            ])
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}