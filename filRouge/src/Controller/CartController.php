<?php

namespace App\Controller;

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
            'controller_name' => 'CartController',
            'items' => $cartService->getFullCart(),
            'total' => $cartService->total()
        ]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart_add")
     * @param $id
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);
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
