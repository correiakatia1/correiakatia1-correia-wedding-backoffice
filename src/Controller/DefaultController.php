<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Repository\AccessoryRepository;
use App\Repository\DressRepository;
use App\Repository\ScheduleRepository;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @var DressRepository
     */
    private $dressRepository;

    /**
     * @var AccessoryRepository
     */
    private $accessoryRepository;

    /**
     * @var ScheduleRepository
     */
    private $scheduleRepository;

    public function __construct(DressRepository $dressRepository, ScheduleRepository $scheduleRepository, AccessoryRepository $accessoryRepository)
    {
        $this->dressRepository = $dressRepository;
        $this->scheduleRepository = $scheduleRepository;
        $this->accessoryRepository =$accessoryRepository;
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
     * @Route ("/Acessorios", name="front_accessories")
     * @return Response
     */
    public function accessoriesAction(): Response
    {
        $accessories = $this->accessoryRepository->findAll();
        return $this->render('frontoffice/accessories.html.twig', [
            'accessories' => $accessories,
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
        return $this->render('frontoffice/dress_details.html.twig', [
            'dress' => $dress,
        ]);
    }

    /**
     * @Route ("/acessorio/{accessoryId}", name="front_accessory_details")
     * @param int $accessoryId
     * @return Response
     */
    public function AccessoryDetailsAction(int $accessoryId): Response
    {
        $accessory = $this->accessoryRepository->find($accessoryId);
        return $this->render('frontoffice/accessory_details.html.twig', [
            'accessory' => $accessory,
        ]);
    }

    /**
     * @Route ("/marque-vesita/{dressId}", name="front_form", methods={"GET"})
     * @return Response
     */
    public function formAction(int $dressId): Response
    {
        $minDate = new DateTime();
        $minDate->add(date_interval_create_from_date_string('1 days'));

        return $this->render('frontoffice/form.html.twig', [
            'minDate' => $minDate->format('Y-m-d'),
            'dressId' => $dressId
        ]);
    }

    /**
     * @Route ("/marque-vesita/{dressId}", name="front_schedule", methods={"POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function scheduleAction(Request $request,$dressId): Response
    {
        $dress = $this->dressRepository->find($dressId);

        $schedule = new Schedule();
        $schedule->setName($request->request->get('name'));
        $schedule->setLastName($request->request->get('last_name'));
        $schedule->setEmail($request->request->get('email'));
        $schedule->setContact($request->request->get('contact'));

        $scheduleDate = new DateTime($request->request->get('date'));
        $schedule->setDate($scheduleDate);

        $weddingDate = new DateTime($request->request->get('wedding_date'));
        $schedule->setWeddingDate( $weddingDate);

        $schedule->setMessage($request->request->get('message'));
        $schedule->setDress($dress);

        $dress->addSchedule($schedule);

        $this ->scheduleRepository ->create($schedule);

        return $this->render('frontoffice/schedule_success.html.twig');


    }
}
