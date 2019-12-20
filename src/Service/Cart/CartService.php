<?php

namespace App\Service\Cart;

use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    //injection de dépendance 
    protected $session;
    protected $eventRepository;

    public function __construct(SessionInterface $session, EventRepository $eventRepository)
    {
        $this->session = $session;
        $this->eventRepository = $eventRepository;
    }

    public function add(int $id)
    {
        //récupére le panier dans la session , regarde si il y a un panier dans la session
        // [] = si il y a pas de panier, met un tableau vide
        $panier = $this->session->get('panier', []);
        // 1 en quantité
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        //garde le panier modifier auparavant
        $this->session->set('panier', $panier);
    }

    public function decrement(int $id)
    {
        //récupére le panier dans la session , regarde si il y a un panier dans la session
        // [] = si il y a pas de panier, met un tableau vide
        $panier = $this->session->get('panier', []);
        // si il existe il décrémente
        if (!empty($panier[$id])) {
            $panier[$id]--;
            //si la valeur est inférieur ou égale à O alors on appelle la fonction remove
            if ($panier[$id] <= 0) {
                $this->remove($id);
                return;
            }
        } 
        $this->session->set('panier', $panier);
        //garde le panier modifier auparavant
    }

    public function remove(int $id)
    {
        //extraire le panier, si rien dans le panier tableau vide
        $panier = $this->session->get('panier', []);

        //si ce n'est pas vide pas mon panier
        if (!empty($panier[$id])) {
            //on supprimer l'élement 
            unset($panier[$id]);
        }
        // nouveau panier, celui qui a été modifié ci-dessus 
        $this->session->set('panier', $panier);
    }

    public function getFullCart(): array
    {
        // récupérer le panier
        $panier = $this->session->get('panier', []);
        // transforme les élements du panier en entité (avec Repo)
        $panierWithData = [];
        // rajoute à chaque fois dans panierWithData un tableau associatif µ
        // tableau avec une liste de couple produit//quantité
        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'event' => $this->eventRepository->find($id),
                'quantity' => $quantity
            ];
        }
        return $panierWithData;
    }

    public function getTotal(): float
    {
        //calcul du total du panier en panier 
        $total = 0;

        foreach ($this->getFullCart() as $item) {
            $total += $item['event']->getPurchasePriceEvent() * $item['quantity'];
        }
        return $total;
    }
}
