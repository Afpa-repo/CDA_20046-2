<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\Order;
use App\Entity\OrderDetail;
use App\Entity\User;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Cart\CartService;


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

    protected $productRepository;
    protected $userRepository;

    public function __construct(ProductRepository $productRepository, UserRepository $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
    }

    public function load(EntityManagerInterface $manager, CartService $cartService)
    {


        $cartService = $cartService->getFullCart();

        $date = new \DateTime();
        $dateShipping = $date->add(new \DateInterval('P1Y'));

        $order = new Order();
        $user = $this->userRepository->find(1);


        $order->setOrderDate($date);
        $order->setOrderDateShipping($dateShipping);
        $order->setOrderType(1);
        $order->setOrderShippingCost(rand(0, 100));

        foreach ($cartService as $key => $value) {

            $user = $value['user'];
            dump($user);
            $order->setUser($user);
            $order->setAddress($user->getAdress());

            $orderDetail = new OrderDetail($key);

            //dd($value["stock"]);
            $orderDetail->setProduct($value["product"]);
            $orderDetail->setOrders($order);
            $orderDetail->setSupplier($value["stock"]->getMaterial()->getSupplier());
            $orderDetail->setStock($value["stock"]);
            $orderDetail->setOrderdetailUnitPrice($value["stock"]->getUnitPrice());
            $orderDetail->setOrderdetailQuantity($value["quantity"]);
            $orderDetail->setOrderdetailDiscount(rand(1, 10) / 10);
            $tva = ($orderDetail->getOrderdetailQuantity() * $orderDetail->getOrderdetailUnitPrice()) * 0.20;
            $orderDetail->setOrderdetailTva($tva);

            $manager->persist($orderDetail);
        }


        $manager->persist($order);

        $manager->flush();

    }

    /**
     * @Route("/order/submit", name="order_submit")
     * @param EntityManagerInterface $manager
     * @param CartService $cartService
     * @return Response
     */
    public
    function submit(EntityManagerInterface $manager, CartService $cartService)
    {


        $this->load($manager, $cartService);


        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
}
