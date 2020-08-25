<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     * @param CartService $cartService
     * @param Request $request
     * @return Response
     */
    public function index(CartService $cartService, Request $request)
    {
           $item = [];
        foreach ($cartService->getFullCart() as $key => $items) {
            $item[] = $items;
        }
        return $this->render('cart/index.html.twig', [
            'items' => $item,
            'total' => $cartService->total(),
            'CartNotification' => sizeof($item),
        ]);
    }

    /**
     * @Route("/cart/add/{idproduct}/{idstock}/{qte}", name="cart_add")
     * @param int $idproduct
     * @param int $idstock
     * @param int $qte
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function add(int $idproduct, int $idstock, int $qte, CartService $cartService)
    {
        $cartService->add($idproduct, $idstock, $qte);
        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/remove/{idproduct}/{idstock}",name ="cart_remove")
     * @param int $idproduct
     * @param int $idstock
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function remove(int $idproduct, int $idstock, CartService $cartService)
    {
        $cartService->remove($idproduct, $idstock);

        return $this->redirectToRoute("cart");
    }

    /**
     * @Route("/cart/update/", name="cart_update", methods={"POST"})
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function update(CartService $cartService,Request $request)
    {




        $qte =$request->request->get("quantity");
        $idproduct =$request->request->get("product");
        $idstock =$request->request->get("stock");



dump( $_POST);




        $cartService->update($idproduct, $idstock, $qte);
        return $this->redirectToRoute("cart");
    }


}
