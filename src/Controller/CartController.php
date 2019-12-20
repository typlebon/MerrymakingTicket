<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Cart\CartService;

class CartController extends AbstractController
{
    /**
     * @Route ("/panier", name="cart_panier")
     */

    public function index(CartService $cartService)
    {
        //calcul du total du panier en panier 
        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal()
        ]);
    }

    /**
     * @Route ("/panier/add/{id}", name="cart_add")
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);
        return $this->redirectToRoute('cart_panier');
    }


    /**
     * @Route ("/panier/decrement/{id}", name="cart_decrement")
     */
    public function decrement($id, CartService $cartService)
    {
        $cartService->decrement($id);
        return $this->redirectToRoute('cart_panier');
    }

    /**
     * @Route ("/panier/remove/{id}", name="cart_remove")
     */
    //supprimer un élément du panier
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);
        //retour à la liste 
        return $this->redirectToRoute("cart_panier");
    }
}
