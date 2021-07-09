<?php

namespace App\Controller\Admin;

use App\Repository\ScheduleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleController extends AbstractController
{
    /**
     * @var ScheduleRepository
     */
    private $scheduleRepository;


    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @Route("/schedule", name="schedule_list")
     */
    public function indexAction(): Response
    {
        $schedules = $this->scheduleRepository->findAll();
        return $this->render('admin/schedule/list.html.twig', [
            'schedules' => $schedules,
        ]);
    }
}
