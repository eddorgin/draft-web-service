<?php

namespace App\Symfony\Api;

use App\WorkDay\Domain\Model\WorkDay;
use App\WorkDay\Infrastructure\Domain\WorkDayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

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
     * @param WorkDayRepository $workDayRepository
     * @return Response
     * @throws \Exception
     */
    public function startWorkDay(WorkDayRepository $workDayRepository)
    {
        $id = $workDayRepository->generateId();
        $workDay = new WorkDay($id);
        $workDay->startWork();
        $response = new Response(
            json_encode([
                'startDateTime' => $workDay->getStartDateTime(),
                'id' => $workDay->getId(),
                'state' => $workDay->getStatus()
            ])
        );
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}