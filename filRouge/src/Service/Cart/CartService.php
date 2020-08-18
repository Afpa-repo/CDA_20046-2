<?php

namespace App\Service\Cart;


use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartService
{
    protected $session;
    protected $productRepository;

    /**
     *
     * @param SessionInterface $session
     * @param ProductRepository $productRepository
     */
    public function __construct(SessionInterface $session, ProductRepository $productRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
    }

    /**
     * Ajout d'un profuit au panier
     * @param int $id
     */
    public function add(int $id)
    {
      /*  definition du panier. Soit une variable 'panier' soit un tableau null*/
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        /* transmision du tableau $panier dans la variable 'panier" */
        $this->session->set('panier', $panier);
    }

    /**
     * Suppresion de l'article du panier
     * @param int $id
     */
    public function remove(int $id)
    {
        $panier = $this->session->get('panier', []);

        /* si c'est different de vide on unset la valeur */
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
    }

    /**
     * Recuperation du panier complet
     * @return array
     */
    public function getFullCart(): array
    {
        $panier = $this->session->get('panier', []);
        $panierWithData = [];

        /* boucle sur la panier et attribut un tableau des valeur du produit et sa quantité */
        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $this->productRepository->find($id),
                'quantity' => $quantity,
            ];
        }
        return $panierWithData;
    }

    /**
     * Calcul du prix total du panier
     * @return float
     */
    public function total(): float
    {
        $total = 0;
        /* Boucle chaque element du panier, recupere le prix grace a la liaison product/Stock  * quantité */
        foreach ($this->getFullCart() as $item) {

            $total += $item['product']->getproductDetail()->getUnitPrice() * $item['quantity'];
        }
        return $total;
    }

}