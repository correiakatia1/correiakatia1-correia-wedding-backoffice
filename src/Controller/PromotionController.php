<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    /**
     * @Route("/promotions", name="promotions_list")
     */
    public function listAction(): Response
    {
        return $this->render('promotion/list.html.twig');
    }

    /**
     * @Route("/promotions/add", name="promotions_add")
     */
    public function addAction(): Response
    {
        return $this->render('promotion/add.html.twig');
    }
}
