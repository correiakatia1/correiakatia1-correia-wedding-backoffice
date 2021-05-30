<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/dress/new", name="dress_new")
     */
    public function new(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            var_dump($request->request->all());die;
        }

        return $this->render('dress/new.html.twig');
    }
}


