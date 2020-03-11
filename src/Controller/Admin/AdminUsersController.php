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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Security\Core\Users;

class AdminUsersController extends AbstractController
{
    /**
     * @var UsersRepository
     */
    private $repository;

    public function __construct(
        UsersRepository $repository,
        EntityManagerInterface $em
    ) {
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
        return $this->render('users/index.html.twig', compact('users'));
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
            //message de confirmation de modification
            $this->addFlash('success', 'Création enregistré');
            //redirection
            return $this->redirectToRoute('admin.users.index');
        }
        return $this->render('new.html.twig', [
            'users' => $users,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/users/{id}", name="admin.users.edit", methods="GET|POST")
     * @param Users $users
     * @return \Symfony\Component\HttpFoundation\Response
     */
    //Modification d'un utilisateur
    public function edit(Users $users, Request $request)
    {
        $form = $this->createForm(UsersType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            //message de confirmation de modification
            $this->addFlash('success', 'Modification enregistré');
            //redirection
            return $this->redirectToRoute('admin.users.index');
        }

        return $this->render('edit.html.twig', [
            'users' => $users,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/users/{id}", name="admin.users.delete", methods="DELETE")
     * @param Users $users
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    //Supression d'un utilisateur
    public function delete(Users $users, Request $request)
    {
        if (
            $this->isCsrfTokenValid(
                'delete' . $users->getId(),
                $request->get('_token')
            )
        ) {
            $this->em->remove($users);
            $this->em->flush();
            //message de confirmation de modification
            $this->addFlash('success', 'Suppression enregistré');
        }
        return $this->redirectToRoute('admin.users.index');
    }
}
