<?php

namespace App\Controller;

use App\Repository\StockRepository;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $renderform = [];
        $item = [];

        foreach ($cartService->getFullCart() as $key => $items) {

            $item[] = $items;

            $stockid[$key] =  $items['stock']->getid();
            $idproduct[$key] =$items['product']->getid();

            $form[$key] = $this->createFormBuilder()
                ->add('quantity', NumberType::class)
                ->add('update', SubmitType::class)
                ->getForm();

            $form[$key]->handleRequest($request);

            $renderform[$key] = $form[$key]->createView();

            if ($form[$key]->isSubmitted() && $form[$key]->isValid()) {
                $data = $form[$key]->getData();
                $quantity[$key] = $data['quantity'];

                return $this->redirect($this->generateUrl('cart_update', array('idproduct' => $idproduct[$key],
                    'idstock' => $stockid[$key], 'qte' => $quantity[$key])));
            }
        }

        return $this->render('cart/index.html.twig', [
            'items' => $item,
            'total' => $cartService->total(),
            'CartNotification' => sizeof($item),
            'form' => $renderform
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
     * @Route("/cart/update/{idproduct}/{idstock}/{qte}", name="cart_update")
     * @param int $idproduct
     * @param int $idstock
     * @param int $qte
     * @param CartService $cartService
     * @return RedirectResponse
     */
    public function update(int $idproduct, int $idstock, int $qte, CartService $cartService)
    {
        $cartService->update($idproduct, $idstock, $qte);
        return $this->redirectToRoute("cart");
    }


}
