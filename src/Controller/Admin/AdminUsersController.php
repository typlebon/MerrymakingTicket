<?php

namespace App\Controller\Admin;


// use App\Controller\Admin\AdminUsersController;
use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Security\Core\Users;

class AdminUsersController extends AbstractController
{
    /**
     * @var UsersRepository
     */
    private $repository;

    public function __construct(UsersRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
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
     * @Route ("/admin/users/create", name="admin.users.new")
     */

    //création d'un users
    public function new(Request $request)
    {
        $users = new Users();
        $form = $this->createForm(UsersType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($users);
            $this->em->flush();
            //redirection
            return $this->redirectToRoute('admin.users.index');
        }
        return $this->render('admin/users/new.html.twig', [
            'users' => $users,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/users/{id}", name="admin.users.edit")
     * @param Users $users
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Users $users, Request $request)
    {
        $form = $this->createForm(UsersType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            //redirection
            return $this->redirectToRoute('admin.users.index');
        }

        return $this->render('edit.html.twig', [
            'users' => $users,
            'form' => $form->createView()
        ]);
    }
}
