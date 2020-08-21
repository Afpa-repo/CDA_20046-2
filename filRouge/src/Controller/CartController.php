<?php

namespace App\Controller;

use App\Repository\StockRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     * @param CartService $cartService
     * @return Response
     */
    public function index(CartService $cartService)
    {

        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->total(),
//            'CartNotification'=>sizeof($cartService->getFullCart())
        ]);
    }

    /**
     * @Route("/cart/add/{idproduct}/{idstock}/{qte}", name="cart_add")
     * @param int $idproduct
     * @param int $idstock
     * @param int $qte
     * @param StockRepository $stockRepository
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function add(int $idproduct,int $idstock,int $qte,StockRepository $stockRepository, CartService $cartService)
    {
        $cartService->add($idproduct,$idstock,$qte);
        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/remove/{id}",name ="cart_remove")
     * @param $id
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);

        return $this->redirectToRoute("cart");
    }


}
