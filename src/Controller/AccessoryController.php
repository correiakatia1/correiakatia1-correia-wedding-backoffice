<?php

namespace App\Controller;

use App\Entity\Accessory;
use App\Entity\AccessoryImage;
use App\Entity\DressImage;
use App\Repository\AccessoryCategoryRepository;
use App\Repository\AccessoryImageRepository;
use App\Repository\AccessoryRepository;
use App\Repository\ColorRepository;
use App\Repository\DetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @var AccessoryRepository
     */
    private $accessoryRepository;

    /**
     * @var AccessoryImageRepository
     */
    private $accessoryImageRepository;



    public function __construct(
        AccessoryCategoryRepository $AccessoryCategoryRepository,
        DetailRepository $DetailRepository,
        ColorRepository $colorRepository,
        AccessoryRepository $accessoryRepository,
        AccessoryImageRepository $accessoryImageRepository
    )
    {
        $this->accessoryCategoryRepository = $AccessoryCategoryRepository;
        $this->detailRepository = $DetailRepository;
        $this->colorRepository = $colorRepository;
        $this->accessoryRepository = $accessoryRepository;
        $this->accessoryImageRepository = $accessoryImageRepository;
    }

    /**
     * @Route("/accessories", name="accessory_list")
     */
    public function indexAction(): Response
    {
        $accessories =$this->accessoryRepository->findAll();
        return $this->render('accessory/list.html.twig',[
            'accessories' => $accessories
        ]);

    }


    /**
     * @Route("/accessories/new", methods={"GET"}, name="accessory_new")
     */
    public function newAction(Request $request): Response
    {
        $details = $this->detailRepository->findAll();
        $colors = $this->colorRepository->findAll();
        $categories = $this->accessoryCategoryRepository->findAll();


        return $this->render('accessory/form.html.twig', [
            'accessory' => new Accessory(),
            'details' => $details,
            'colors' => $colors,
            'accessoryCategories' => $categories,
        ]);
    }

    /**
     * @Route("/accessories/new", methods={"POST"})
     */
    public function createAction(Request $request): Response
    {
        $accessory = new Accessory();
        $accessory->setName($request->request->get('name'));
        $accessory->setPrice((float)$request->request->get('price'));


        $accessoryCategory = $this->accessoryCategoryRepository->find($request->request->get('category'));
        $colors = $this->colorRepository->findBy(['id' => $request->request->get('colors')]);
        $details = $this->detailRepository->findBy(['id' => $request->request->get('details')]);

        $accessory->setAccessoryCategory($accessoryCategory);

        foreach ($colors as $color) {
            $accessory->addColor($color);
        }
        foreach ($details as $detail) {
            $accessory->addDetail($detail);
        }

        $this->accessoryRepository->create($accessory);

        return $this->redirectToRoute('accessory_list');
    }

    /**
     * @Route("/accessory/update/{accessoryId}", name="accessory_update", methods={"GET"})
     */
    public function updateAction( $accessoryId, Request $request): Response
    {
        $accessory = $this-> accessoryRepository->find( $accessoryId);

        $details = $this->detailRepository->findAll();
        $accessoryCategories = $this->accessoryCategoryRepository->findAll();
        $colors = $this->colorRepository->findAll();

        return $this->render('accessory/form.html.twig', [
            'details' => $details,
            'accessoryCategories' =>  $accessoryCategories,
            'colors' => $colors,
            'accessory' =>  $accessory,
        ]);
    }

    /**
     * @Route("/accessory/update/{accessoryId}", name="accessory_edit", methods={"POST"})
     */
    public function editAction($accessoryId, Request $request): RedirectResponse
    {
        $accessory = $this->accessoryRepository->find($accessoryId);
        $accessory->setName($request->request->get('name'));
        $accessory->setPrice((float)$request->request->get('price'));


        $accessoryCategory = $this->accessoryCategoryRepository->find($request->request->get('category'));
        $colors = $this->colorRepository->findBy(['id' => $request->request->get('colors')]);
        $details = $this->detailRepository->findBy(['id' => $request->request->get('details')]);

        $accessory->setAccessoryCategory($accessoryCategory);

        $accessory->resetColor();
        foreach ($colors as $color) {
            $accessory->addColor($color);
        }

        $accessory->resetDetails();
        foreach ($details as $detail) {
            $accessory->addDetail($detail);
        }

        $this->accessoryRepository->flush();

        return $this->redirectToRoute('accessory_list');
    }


    /**
     * @Route("/accessory/{accessoryId}/upload-images", name="accessory_upload_images", methods={"POST"})
     */
    public function newImageAction(Request $request, int $accessoryId)
    {
        $accessory = $this->accessoryRepository->find($accessoryId);

        foreach ($request->files->get('images') as $file) {
            $accessoryImage = new AccessoryImage();
            $accessoryImage->setName($file->getFilename());
            $accessoryImage->setAccessory($accessory);

            $this->accessoryImageRepository->create($accessoryImage);

            $fileName = $accessoryImage->getId() . '.' . DressImage::MIME_TYPES[$file->getMimeType()];
            $file->move(
                'custom/images/accessory',
                $fileName
            );

            $accessoryImage->setName('/custom/images/accessory/' . $fileName);
        }

        $this->accessoryImageRepository->flush();
        return $this->redirectToRoute('accessory_update', ['accessoryId' => $accessory->getId()]);
    }











}
