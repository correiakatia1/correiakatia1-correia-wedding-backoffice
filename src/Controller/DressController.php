<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DressController extends AbstractController
{
    /**
     * @Route("/dress", name="dress_list")
     */
    public function index(): Response
    {
        return $this->render('dress/list.html.twig');
    }
}
