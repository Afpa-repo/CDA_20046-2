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
    public function load(EntityManagerInterface $manager, CartService  $cartService)
    {

        $date = new \DateTime();
        $dateShipping = $date->add(new \DateInterval('P1Y'));

        $order = new Order();
        $user =$this->userRepository->find(1);

        $order->setUser($user);
        $order->setAddress($user->getAdress());
        $order->setOrderDate($date);
        $order->setOrderDateShipping($dateShipping);
        $order->setOrderType(1);
        $order->setOrderShippingCost(rand(0, 100));

        dd($cartService);
        foreach($cartService as $key) {
                $orderDetail = new OrderDetail($key);


                $orderDetail->setOrders($order);
                $orderDetail->setSupplier($cartService->stock->getMaterial()->getSupplier());
                $orderDetail->setStock($cartService->stock);
                $orderDetail->setOrderdetailUnitPrice($cartService->stock->getUnitPrice());
                $orderDetail->setOrderdetailQuantity($cartService->quantity);
                $orderDetail->setOrderdetailDiscount(rand(1, 10) / 10);
                $orderDetail->setOrderdetailTva(rand(0,100));

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
