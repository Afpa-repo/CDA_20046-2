<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderDetailRepository::class)
 */
class OrderDetail
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderdetailUnitPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderdetailQuantity;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $orderdetailDiscount;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderdetailTva;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="orderDetails")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="detail")
     */
    private $orders;

    /**
     * @ORM\ManyToOne(targetEntity=Suppliers::class, inversedBy="orderDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $supplier;

    /**
     * @ORM\ManyToOne(targetEntity=Stock::class, inversedBy="orderDetails")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stock;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderdetailUnitPrice(): ?int
    {
        return $this->orderdetailUnitPrice;
    }

    public function setOrderdetailUnitPrice(int $orderdetailUnitPrice): self
    {
        $this->orderdetailUnitPrice = $orderdetailUnitPrice;

        return $this;
    }

    public function getOrderdetailQuantity(): ?int
    {
        return $this->orderdetailQuantity;
    }

    public function setOrderdetailQuantity(int $orderdetailQuantity): self
    {
        $this->orderdetailQuantity = $orderdetailQuantity;

        return $this;
    }

    public function getOrderdetailDiscount(): ?int
    {
        return $this->orderdetailDiscount;
    }

    public function setOrderdetailDiscount(?int $orderdetailDiscount): self
    {
        $this->orderdetailDiscount = $orderdetailDiscount;

        return $this;
    }

    public function getOrderdetailTva(): ?int
    {
        return $this->orderdetailTva;
    }

    public function setOrderdetailTva(int $orderdetailTva): self
    {
        $this->orderdetailTva = $orderdetailTva;

        return $this;
    }

    public function getProduct(): ?product
    {
        return $this->product;
    }

    public function setProduct(?product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getOrders(): ?Order
    {
        return $this->orders;
    }

    public function setOrders(?Order $orders): self
    {
        $this->orders = $orders;

        return $this;
    }

    public function getSupplier(): ?Suppliers
    {
        return $this->supplier;
    }

    public function setSupplier(?Suppliers $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

        return $this;
    }
}
