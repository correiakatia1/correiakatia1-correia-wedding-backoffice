<?php

namespace App\Controller\Admin;

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
        return $this->render('admin/schedule/index.html.twig', [
            'controller_name' => 'ScheduleController',
        ]);
    }
}
