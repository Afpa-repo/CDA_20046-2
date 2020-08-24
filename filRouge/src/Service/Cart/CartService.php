<?php

namespace App\Service\Cart;


use App\Repository\ProductRepository;
use App\Repository\StockRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartService
{
    protected $session;
    protected $productRepository;
    protected $stockRepository;

    /**
     *
     * @param SessionInterface $session
     * @param ProductRepository $productRepository
     * @param StockRepository $stockRepository
     */
    public function __construct(SessionInterface $session, ProductRepository $productRepository, StockRepository $stockRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
    }

    /**
     * Ajout d'un produit au panier
     * @param int $idproduct
     * @param int $idstock
     * @param int $qte
     */
    public function add(int $idproduct, int $idstock, int $qte)
    {
        /*  definition du panier. Soit une variable 'panier' soit un tableau null*/
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$idproduct][$idstock])) {
            $panier[$idproduct][$idstock] += $qte;
        } else {
            $panier[$idproduct][$idstock] = $qte;
        }

        /* transmision du tableau $panier dans la variable 'panier" */
        $this->session->set('panier', $panier);

    }

    /**
     * Recuperation du panier complet
     * @return object
     */
    public function getFullCart(): object
    {
        $panier = $this->session->get('panier', []);

        $panierWithData = [];
        /* boucle sur la panier et attribut un tableau des valeur du produit et sa quantité */

        foreach ($panier as $idproduct => $item) {
            foreach ($item as $idstock => $qte) {

                $panierWithData[] = [
                    'product' => $this->productRepository->find($idproduct),
                    /*
                    $formatmaterialID = La valeur que retourne le ajax a Dan
                      'unitprice'=> $this->stockRepository->find($formatmaterialID),*/
                    'stock' => $this->stockRepository->find($idstock),
                    'quantity' => $qte,
//              'userid' => ,
                ];
            }
        }
        return (object)$panierWithData;
    }

    /**
     * Suppresion de l'article du panier
     * @param int $idproduct
     * @param int $idstock
     */
    public function remove(int $idproduct, int $idstock)
    {
        $panier = $this->session->get('panier', []);

        /* si c'est different de vide on unset la valeur */
        if (!empty($panier[$idproduct][$idstock])) {
            unset($panier[$idproduct][$idstock]);
        }
        $this->session->set('panier', $panier);
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
            $total += $item['stock']->getUnitPrice() * $item['quantity'];
        }
        return $total;
    }

    public function update(int $idproduct, int $idstock, int $qte)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$idproduct][$idstock])) {
            $panier[$idproduct][$idstock] = $qte;
        }

        /* transmision du tableau $panier dans la variable 'panier" */
        $this->session->set('panier', $panier);
    }

}