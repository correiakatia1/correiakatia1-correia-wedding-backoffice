<?php

namespace App\Controller;

use App\Entity\Accessory;
use App\Entity\User;
use App\Repository\UserRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DressController extends AbstractController
{

    /**
     * @Route("/dress", name="dress_list")
     */
    public function index(UserRepository $userRepository): Response
    {
        /*$user = new User();
        $user
            ->setName("Katia")
            ->setEmail("correia@email.com")
            ->setIsActive(true)
            ->setCreatedAt(new DateTime())
            ->setUpdatedAt(new DateTime());
        $userRepository->persistUser($user);*/

        $user = $userRepository->find(1);

        $accessory = new Accessory();
        /*$accessory->getAccessoryCategory()->getName();*/


        return $this->render('dress/list.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/dress/new", name="dress_new")
     */
    public function new(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            var_dump($request->request->all());
            die;
        }

        return $this->render('dress/new.html.twig');
    }
}


