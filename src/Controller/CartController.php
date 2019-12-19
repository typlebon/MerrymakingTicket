<?php 

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController 
{
    /**
     * @Route ("/panier", name="cart_panier")
     */

     public function index(SessionInterface $session, EventRepository $eventRepository)
     {
         // récupérer le panier
        $panier = $session->get('panier', []);
         // transforme les élements du panier en entité (avec Repo)
        $panierWithData = [];
        // rajoute à chaque fois dans panierWithData un tableau associatif µ
        // tableau avec une liste de couple produit//quantité
        foreach($panier as $id => $quantity) {
            $panierWithData[] = [
                'event' => $eventRepository->find($id),
                'quantity' => $quantity
            ];
        }

        //calcul du total du panier en panier 
        $total = 0;
        
        foreach($panierWithData as $item) {
            $totalItem = $item['event']->getPurchasePriceEvent() * $item['quantity'];
            $total += $totalItem;
        }

         return $this->render ('cart/index.html.twig', [
             'items' => $panierWithData,
             'total' => $total
         ]);
     }

     /**
      * @Route ("/panier/add/{id}", name="cart_add")
      */
     public function add($id, SessionInterface $session)
     {
         
        dump($session->get('panier'));
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
         return $this->redirectToRoute('event_index');
     }
    
     /**
      * @Route ("/panier/remove/{id}", name="cart_remove")
      */
      //supprimer un élément du panier
      public function remove($id, SessionInterface $session) {
          //extraire le panier, si rien dans le panier tableau vide
          $panier = $session->get('panier', []);

          //si ce n'est pas vide pas mon panier
          if(!empty($panier[$id])) {
              //on supprimer l'élement 
              unset($panier[$id]);
          }
          // nouveau panier, celui qui a été modifié ci-dessus 
          $session->set('panier', $panier);

          //retour à la liste 
          return $this->redirectToRoute("cart_panier");
      }
}