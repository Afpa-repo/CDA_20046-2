<?php
// En construction
namespace App\Service\Star;


use App\Repository\ProductRepository;


class CartService
{
    protected $productRepository;

    /**
     *
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Ajout d'une note
     * @param int $id
     */
    public function add(int $id, ProductRepository $productRepository)
    {


    }

    /**
     * Calcul
     * @return float
     */
    public function total(): float
    {
        $total = 0;

    }

}