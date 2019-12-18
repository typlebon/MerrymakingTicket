<?php 


namespace App\Controller;

use App\Repository\FicheArtisteRepository;
use App\Entity\FicheArtiste;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FicheArtisteController extends AbstractController
{
    /**
     * @var FicheArtisteRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(FicheArtisteRepository $repository)
    {
        $this->repository = $repository;
        // $this->em =$em;
    }


    /**
     * @Route("/FicheArtiste", name="FicheArtiste.index")
     */
    public function toto(): Response
    {
        //récupére un tableau de fiche artiste dans le repository (avec un s car il y en a plusieurs )
        $fichesArtiste = $this->repository->findAllVisible();
        //retourne la vue twig
        return $this->render(
            'FicheArtiste.html.twig', 
            [
                'current_menu' => 'FicheArtiste',
                'FichesArtiste' => $fichesArtiste 
            ]
        );
    }

    /**
     * @Route("/FicheArtiste/new", name="FicheArtiste.new")
     */
    public function new() : Response {
        return new Response("Hello");
    }

}
