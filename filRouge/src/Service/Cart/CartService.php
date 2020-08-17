<?php

namespace App\Service\Cart;


use App\Repository\OrderDetailRepository;
use App\Repository\ProductRepository;
use App\Repository\StockRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartService
{
    protected $session;
    protected $productRepository;
    protected $stockRepository;

    /**
     * @param SessionInterface $session
     * @param ProductRepository $productRepository
     * @param StockRepository $stockRepository
     */
    public function __construct(SessionInterface $session, ProductRepository $productRepository,StockRepository $stockRepository)
    {
        $this->session = $session;
        $this->productRepository = $productRepository;
        $this->stockRepository=$stockRepository;
    }

    public function add(int $id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $this->session->set('panier', $panier);
    }

    public function remove(int $id)
    {
        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
    }

    public function getFullCart(): array
    {

        $panier = $this->session->get('panier', []);
        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $this->productRepository->find($id),
                'quantity' => $quantity,
            ];
        }
        return $panierWithData;
    }

    public function total(): float
    {
        $total = 0;
        foreach ($this->getFullCart() as $item) {

            $total += $item['product']->getstock()->getUnitPrice() * $item['quantity'];
        }
        return $total;
    }

}