<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;


    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {
        // //récupère les propriétées de l'élement avec l'ID 1
        // $property = $this->repository->find(1);
        // dump($property);
        return $this->render(
            'property/index.html.twig',
            ['current_menu' => 'properties']
        );
    }
}
