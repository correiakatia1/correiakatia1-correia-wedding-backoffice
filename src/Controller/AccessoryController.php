<?php

namespace App\Controller;

use App\Entity\Accessory;
use App\Repository\AccessoryCategoryRepository;
use App\Repository\ColorRepository;
use App\Repository\DetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccessoryController extends AbstractController
{
    /**
     * @var AccessoryCategoryRepository
     */
    private $accessoryCategoryRepository;
    /**
     * @var DetailRepository
     */
    private $detailRepository;
    /**
     * @var ColorRepository
     */
    private $colorRepository;



    public function __construct(
        AccessoryCategoryRepository $AccessoryCategoryRepository,
        DetailRepository $DetailRepository,
        ColorRepository $colorRepository
    )
    {
        $this->accessoryCategoryRepository = $AccessoryCategoryRepository;
        $this->detailRepository = $DetailRepository;
        $this->colorRepository = $colorRepository;
    }

    /**
     * @Route("/accessories", name="accessory_list")
     */
    public function index(): Response
    {
        return $this->render('accessory/list.html.twig');
    }

    /**
     * @Route("/accessories/new", name="accessory_new")
     */
    public function new(): Response
    {
        $details = $this->detailRepository->findAll();
        $colors = $this->colorRepository->findAll();
        $categories = $this->accessoryCategoryRepository->findAll();




        $accessory = new Accessory();
        return $this->render('accessory/new.html.twig', [
            'accessory' => $accessory,
            'details' => $details,
            'colors' => $colors,
            'accessoryCategories'=>$categories,
        ]);
    }
}
