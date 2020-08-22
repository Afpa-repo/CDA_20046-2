<?php

namespace App\Controller;

use App\Repository\StockRepository;
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
     * @return Response
     */
    public function index(CartService $cartService, StockRepository $stockRepository)
    {
        foreach ($cartService->getFullCart() as  $items) {
           $item[] = $items;
        }

        return $this->render('cart/index.html.twig', [
            'items' => $item,
            'total' => $cartService->total(),
            'CartNotification'=>sizeof($item)

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
    public function add(int $idproduct, int $idstock, int $qte, StockRepository $stockRepository, CartService $cartService)
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
     * @Route("/cart/update/{idproduct}/{idstock}/{qte}", name="cart_update")
     * @param int $idproduct
     * @param int $idstock
     * @param int $qte
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function update(int $idproduct, int $idstock, int $qte, CartService $cartService,Request $request)
    {
/*
        $cart = new Cart();
        $form = $this->createForm(TaskType::class, $task);

        if ($request->isMethod('POST')) {
            $form->submit($request->request->get($form->getName()));

            if ($form->isSubmitted() && $form->isValid()) {
                // perform some action...

                return $this->redirectToRoute('task_success');
            }



*/



        $cartService->update($idproduct, $idstock, $qte);
        return $this->redirectToRoute("cart");
    }


}
