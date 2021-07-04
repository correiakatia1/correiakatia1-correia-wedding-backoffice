<?php

namespace App\Controller;

use App\Repository\DressRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @var DressRepository
     */
    private $dressRepository;

    public function __construct(DressRepository $dressRepository)
    {
        $this->dressRepository = $dressRepository;
    }

    /**
     * @Route("/", name="front_home_page")
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('frontoffice/home_page.html.twig');
    }

    /**
     * @Route("/sobre-nos", name="front_about_us")
     * @return Response
     */
    public function aboutUsAction(): Response
    {
        return $this->render('frontoffice/about_us.html.twig');
    }

    /**
     * @Route ("/vestidos", name="front_dresses")
     * @return Response
     */
    public function dressesAction(): Response
    {
        $dresses = $this->dressRepository->findAll();
        return $this->render('frontoffice/dresses.html.twig', [
            'dresses' => $dresses,
        ]);
    }

    /**
     * @Route ("/galeria", name="front_gallery")
     * @return Response
     */
    public function galleryAction(): Response
    {
        return $this->render('frontoffice/gallery.html.twig');
    }

    /**
     * @Route ("/contacto", name="front_contact")
     * @return Response
     */
    public function contactAction(): Response
    {
        return $this->render('frontoffice/contact.html.twig');
    }

    /**
     * @Route ("/vestidos/{dressId}", name="front_dress_details")
     * @param int $dressId
     * @return Response
     */
    public function dressDetailsAction(int $dressId): Response
    {
        $dress = $this->dressRepository->find($dressId);
        return $this->render('frontoffice/dress_details.html.twig',[
            'dress' =>$dress,
        ]);
    }

    /**
     * @Route ("/marque-vesita/{dressId}", name="front_form")
     * @return Response
     */
    public function formAction(): Response
    {
        $minDate = new DateTime();
        $minDate->add(date_interval_create_from_date_string('1 days'));

        return $this->render('frontoffice/form.html.twig', [
            'minDate' => $minDate->format('Y-m-d'),
        ]);
    }
}
