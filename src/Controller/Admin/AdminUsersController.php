<?php

namespace App\Controller\Admin;

// use App\Controller\Admin\AdminUsersController;
use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Security\Core\Users;

class AdminUsersController extends AbstractController
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
     * @Route ("/admin", name="admin.users.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $users = $this->repository->findAll();
        return $this->render('index.html.twig', compact('users'));
    }

    /**
     * @Route("/admin/{id}", name="admin.users.edit")
     * @param Users $users
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Users $users)
    {
        $form = $this->createForm(UsersType::class, $users);
        return $this->render('edit.html.twig', [
            'users' => $users,
            'form' => $form->createView()
        ]);
    }
}
