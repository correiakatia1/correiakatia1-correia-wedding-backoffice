<?php

namespace App\Controller\Admin;

use App\Entity\Dress;
use App\Entity\DressImage;
use App\Repository\ColorRepository;
use App\Repository\DetailRepository;
use App\Repository\DressCategoryRepository;
use App\Repository\DressImageRepository;
use App\Repository\DressRepository;
use App\Repository\SizeRepository;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class DressController extends AbstractController
{
    /**
     * @var DetailRepository
     */
    private $detailRepository;

    /**
     * @var DressCategoryRepository
     */
    private $categoryRepository;

    /**
     * @var ColorRepository
     */
    private $colorRepository;

    /**
     * @var SizeRepository
     */
    private $sizeRepository;

    /**
     * @var DressRepository
     */
    private $dressRepository;

    /**
     * @var DressImageRepository
     */
    private $dressImageRepository;

    /**
     * KernelInterface $appKernel
     */
    private $appKernel;

    public function __construct(
        DetailRepository $detailRepository,
        DressCategoryRepository $categoryRepository,
        ColorRepository $colorRepository,
        SizeRepository $sizeRepository,
        DressRepository $dressRepository,
        DressImageRepository $dressImageRepository,
        KernelInterface $appKernel
    )
    {
        $this->detailRepository = $detailRepository;
        $this->categoryRepository = $categoryRepository;
        $this->colorRepository = $colorRepository;
        $this->sizeRepository = $sizeRepository;
        $this->dressRepository = $dressRepository;
        $this->dressImageRepository = $dressImageRepository;
        $this->appKernel = $appKernel;
    }

    /**
     * @Route("/dress", name="dress_list", methods={"GET"})
     */
    public function indexAction(): Response
    {
        $dresses = $this->dressRepository->findAll();
        return $this->render('admin/dress/list.html.twig', [
            'dresses' => $dresses,
        ]);
    }

    /**
     * @Route("/dress/new", name="dress_new", methods={"GET"})
     */
    public function newAction(Request $request): Response
    {
        $details = $this->detailRepository->findAll();
        $dressCategories = $this->categoryRepository->findAll();
        $colors = $this->colorRepository->findAll();
        $sizes = $this->sizeRepository->findAll();

        return $this->render('admin/dress/form.html.twig', [
            'details' => $details,
            'dressCategories' => $dressCategories,
            'colors' => $colors,
            'sizes' => $sizes,
            'dress' => new Dress(),
        ]);
    }

    /**
     * @Route("/dress/new", name="dress_create", methods={"POST"})
     */
    public function createAction(Request $request): Response
    {
        $dress = new Dress();
        $dress->setName($request->request->get('name'));
        $dress->setPrice((float)$request->request->get('price'));
        $dress->setDescription($request->request->get('description'));

        $dressCategory = $this->categoryRepository->find($request->request->get('category'));
        $colors = $this->colorRepository->findBy(['id' => $request->request->get('colors')]);
        $details = $this->detailRepository->findBy(['id' => $request->request->get('details')]);
        $sizes = $this->sizeRepository->findBy(['id' => $request->request->get('sizes')]);

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

        $this->dressRepository->create($dress);

        return $this->redirectToRoute('dress_list');
    }

    /**
     * @Route("/dress/update/{dressId}", name="dress_update", methods={"GET"})
     */
    public function updateAction($dressId, Request $request): Response
    {
        $dress = $this->dressRepository->find($dressId);

        $details = $this->detailRepository->findAll();
        $dressCategories = $this->categoryRepository->findAll();
        $colors = $this->colorRepository->findAll();
        $sizes = $this->sizeRepository->findAll();

        return $this->render('admin/dress/form.html.twig', [
            'details' => $details,
            'dressCategories' => $dressCategories,
            'colors' => $colors,
            'sizes' => $sizes,
            'dress' => $dress,
        ]);
    }

    /**
     * @Route("/dress/update/{dressId}", name="dress_edit", methods={"POST"})
     */
    public function editAction($dressId, Request $request): RedirectResponse
    {
        $dress = $this->dressRepository->find($dressId);
        $dress->setName($request->request->get('name'));
        $dress->setPrice((float)$request->request->get('price'));
        $dress->setDescription($request->request->get('description'));

        $dressCategory = $this->categoryRepository->find($request->request->get('category'));
        $colors = $this->colorRepository->findBy(['id' => $request->request->get('colors')]);
        $details = $this->detailRepository->findBy(['id' => $request->request->get('details')]);
        $sizes = $this->sizeRepository->findBy(['id' => $request->request->get('sizes')]);

        $dress->setDressCategory($dressCategory);

        $dress->resetColor();
        foreach ($colors as $color) {
            $dress->addColor($color);
        }

        $dress->resetDetails();
        foreach ($details as $detail) {
            $dress->addDetail($detail);
        }

        $dress->resetSize();
        foreach ($sizes as $size) {
            $dress->addSize($size);
        }

        $this->dressRepository->flush();

        return $this->redirectToRoute('dress_list');
    }

    /**
     * @Route("/dress/{dressId}/upload-images", name="dress_upload_images", methods={"POST"})
     */
    public function newImageAction(Request $request, int $dressId)
    {
        $dress = $this->dressRepository->find($dressId);

        /** @var UploadedFile $file */
        foreach ($request->files->get('images') as $file) {
            $dressImage = new DressImage();
            $dressImage->setName($file->getFilename());
            $dressImage->setDress($dress);

            $this->dressImageRepository->create($dressImage);

            $fileName = $dressImage->getId() . '.' . $file->getClientOriginalExtension();
            $file->move(
                'custom/images/dress',
                $fileName
            );

            $dressImage->setName('/custom/images/dress/' . $fileName);
        }

        $this->dressImageRepository->flush();
        return $this->redirectToRoute('dress_update', ['dressId' => $dress->getId()]);
    }

    /**
     * @Route("/dress/delete/{dressId}", name="dress_delete", methods={"POST"})
     * @throws ORMException
     */
    public function deleteAction(int $dressId): RedirectResponse
    {
        $dress = $this->dressRepository->find($dressId);

        $dress->resetSize();
        $dress->resetColor();
        $dress->resetDetails();

        foreach ($dress->getDressImages() as $image) {
            unlink(
                $this->appKernel->getProjectDir() . '/public' . $image->getName()
            );

            $this->dressImageRepository->remove($image);
        }

        $dress->resetImage();

        $this->dressRepository->flush();

        $this->dressRepository->remove($dress);
        $this->dressRepository->flush();

        return $this->redirectToRoute('dress_list');
    }
}
