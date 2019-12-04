<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Reponse;

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

    /**
     * @Route("/biens/{slug}-{id}", name="property.show"), requierements={"slug": [a-z0-9\-]*"})
     * @param Property $property
     * @return Response
     */
    //noms doivent correspondre à la route
    public function show(Property $property, string $slug): Response
    {
        if($property->getSlug() !== $slug){
            $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301); // code 301 : redirection permanente 
        }
        return $this->render('property/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }
}
