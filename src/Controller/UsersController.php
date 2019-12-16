<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @var UsersRepository
     */
    private $repository;


    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @Route("/concerts", name="users.index")
     * @return Response
     */
    public function index(): Response
    {
        $users = $this->repository->findAll();
        return $this->render(
            'users/index.html.twig',
            [
                'current_menu' => 'users',
                'users' => $users
            ]
        );
    }

    /**
     * @Route("/users/{slug}-{id}", name="users.show"), requierements={"slug": [a-z0-9\-]*"})
     * @param Users $users
     * @return Response
     */
    //noms doivent correspondre à la route
    public function show(Users $users, string $slug): Response
    {
        if ($users->getSlug() !== $slug) {
            $this->redirectToRoute('users/users.show', [
                'id' => $users->getId(),
                'slug' => $users->getSlug()
            ], 301); // code 301 : redirection permanente 
        }
        return $this->render('users/show.html.twig', [
            'users' => $users,
            'current_menu' => 'users'
        ]);
    }
}
