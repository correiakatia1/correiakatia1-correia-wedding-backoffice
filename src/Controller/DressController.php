<?php

namespace App\Controller;

use App\Entity\Dress;
use App\Repository\ColorRepository;
use App\Repository\DetailRepository;
use App\Repository\DressCategoryRepository;
use App\Repository\DressRepository;
use App\Repository\SizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DressController extends AbstractController
{

    /**
     * @Route("/dress", name="dress_list")
     */
    public function index(DressRepository $dressRepository): Response
    {
        $dresses = $dressRepository->findAll();
        return $this->render('dress/list.html.twig', [
            'dresses' => $dresses,
        ]);
    }

    /**
     * @Route("/dress/new", name="dress_new")
     */
    public function new(
        Request $request,
        DetailRepository $detailRepository,
        DressCategoryRepository $categoryRepository,
        ColorRepository $colorRepository,
        SizeRepository $sizeRepository,
        DressRepository $dressRepository
    ): Response
    {
        if ($request->getMethod() === 'POST') {
            $dress = new Dress();
            $dress->setName($request->request->get('name'));
            $dress->setPrice((float)$request->request->get('price'));
            $dress->setDescription($request->request->get('description'));

            $dressCategory = $categoryRepository->find($request->request->get('category'));
            $colors = $colorRepository->findBy(['id' => $request->request->get('colors')]);
            $details = $detailRepository->findBy(['id' => $request->request->get('details')]);
            $sizes = $sizeRepository->findBy(['id' => $request->request->get('sizes')]);

            $dress->setDressCategory($dressCategory);

            foreach ($colors as $color) {
                $dress->addColor($color);
            }

            foreach ($details as $detail) {
                $dress->addDetail($detail);
            }
            foreach ($sizes as $size) {
                $dress->addSize($size);
            }

            $dressRepository->create($dress);

            return $this->redirectToRoute('dress_list');
        }

        $details = $detailRepository->findAll();
        $dressCategories = $categoryRepository->findAll();
        $colors = $colorRepository->findAll();
        $sizes = $sizeRepository->findAll();

        return $this->render('dress/new.html.twig', [
            'details' => $details,
            'dressCategories' => $dressCategories,
            'colors' => $colors,
            'sizes' => $sizes
        ]);
    }

}


