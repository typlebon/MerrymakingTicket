<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $users = new Users();
        $form = $this->createForm(UsersType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($users->getPasswordUsers() == $users->getRetypePasswordUsers()){
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($users);
                $entityManager->flush();
                return $this->redirectToRoute('users.index');
            }
        }

        return $this->render('users/new.html.twig', [
            'users' => $users,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Users $users): Response
    {
        $form = $this->createForm(UsersType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('users.index');
        }

        return $this->render('users/edit.html.twig', [
            'users' => $users,
            'form' => $form->createView(),
        ]);
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

        /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Users $users): Response
    {
        if ($this->isCsrfTokenValid('delete'.$users->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($users);
            $entityManager->flush();
            return $this->redirectToRoute('event_index');
        } 

        return $this->redirectToRoute('users.index');
    }
}
