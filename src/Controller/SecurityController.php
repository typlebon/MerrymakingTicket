<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController {

    /**
     * @Route ("/login", name="login")
     */

     //authenticationUtils = class pour l'authentifaction
    public function login(AuthenticationUtils $authenticationUtils){
        //afficher les erreurs 
        $error = $authenticationUtils->getLastAuthenticationError();
        //dernier mail rentré par utilisateur 
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig',[
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/logout", name="app_logout", methods={"GET"})
     */
    public function logout(){
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
        return $this->redirectToRoute('accueil/index');
    }
}