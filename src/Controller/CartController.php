<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController 
{
    /**
     * @Route ("/panier", name="cart_panier")
     */

     public function index()
     {
         // récupérer le panier

         // transforme les élements du panier en entité (avec Repo)


         return $this->render ('cart/index.html.twig', [
             "events" => []
         ]);
     }

     /**
      * @Route ("/panier/add/{id}", name="cart_add")
      */
     public function add($id, Request $request)
     {
         $session = $request->getSession();
        //récupére le panier dans la session , regarde si il y a un panier dans la session
        // [] = si il y a pas de panier, met un tableau vide
         $panier = $session->get('panier', []);
        // 1 en quantité
        if (isset($panier[$id])){
            $panier[$id] += 1;
        }
        else {
            $panier[$id] = 1;
        }
        //garde le panier modifier auparavant
         $session->set('panier', $panier);
        
         dd($session->get('panier'));
     }
    
}