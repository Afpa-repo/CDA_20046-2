<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Cart\CartService;
use Doctrine\Common\Persistence\ObjectManager;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index()
    {
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    /**
     * @Route("/order/submit", name="order_submit")
     */
    public function submit(CartService $cartService)
    {
        $cartService = $cartService->getFullCart();

        dd($cartService[0]["stock"]->getMaterial());
        $date = new \DateTime();
        $dateShipping = $date->add(new \DateInterval('P3D'));

        $order = new Order();

        $order->setUser(new User(1));
        $order->setAddress(new Address(1));
        $order->setOrderDate($date);
        $order->setOrderDateShipping($dateShipping);
        $order->setOrderType("Envoyée !");
        $order->setOrderShippingCost(rand(0,100));

        for($i=0;$i<=sizeOf($cartService);$i++) {

            for($j=0;$j<=sizeOf($cartService[$i]["product"]);$j++) {

                $orderDetail = new OrderDetail();

                $orderDetail->setProduct($cartService[$i]["product"]->getId($j));
                $orderDetail->setOrders($order);
                $orderDetail->setSupplier($cartService[$i]["stock"]->getMaterial()->getSupplier());

            }
        }
        
        


        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
}
