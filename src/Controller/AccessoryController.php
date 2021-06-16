<?php

namespace App\Controller;

use App\Entity\Accessory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccessoryController extends AbstractController
{
    /**
     * @Route("/accessories", name="accessory_list")
     */
    public function index(): Response{
        return $this->render('accessory/list.html.twig');
    }

    /**
     * @Route("/accessories/new", name="accessory_new")
     */
    public function new(): Response
    {
        $accessory = new Accessory();
        return $this->render('accessory/new.html.twig', [
            'accessory' => $accessory
        ]);
    }
}
