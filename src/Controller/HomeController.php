<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    /**
     * @Route("/", name="home")
     * @param UsersRepository $repository
     * @return Response
     */
    public function index(UsersRepository $repository): Response // specification à php du retour d'un objet response
    {
        $users = $repository->findLatest();
        return $this->render('pages/home.html.twig', [// appel de la vue se situant dans templates/page/ 
            'users' => $users
        ]); 
    }

}
