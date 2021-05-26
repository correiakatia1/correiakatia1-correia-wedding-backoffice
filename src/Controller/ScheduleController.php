<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleController extends AbstractController
{
    /**
     * @Route("/schedule", name="schedule_list")
     */
    public function index(): Response
    {
        return $this->render('schedule/index.html.twig', [
            'controller_name' => 'ScheduleController',
        ]);
    }
}
