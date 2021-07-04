<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StartController extends AbstractController
{
    /**
     * @Route("/start", name="start")
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->render('admin/start/index.html.twig', [
            'controller_name' => 'StartController',
        ]);
    }
}
