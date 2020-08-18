<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
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
    private $unit_stock;

    /**
     * @ORM\Column(type="integer")
     */
    private $unitOnOrder;

    /**
     * @ORM\Column(type="boolean")
     */
    private $discontinued;

    /**
     * @ORM\Column(type="boolean")
     */
    private $flag;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetail::class, mappedBy="stock")
     */
    private $orderDetails;

    /**
     * @ORM\ManyToOne(targetEntity=ProductDetail::class, inversedBy="stocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productDetail;

    public function __construct()
    {
     $this->orderDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnitStock(): ?int
    {
        return $this->unit_stock;
    }

    public function setUnitStock(int $unit_stock): self
    {
        $this->unit_stock = $unit_stock;

        return $this;
    }

    public function getUnitOnOrder(): ?int
    {
        return $this->unitOnOrder;
    }

    public function setUnitOnOrder(int $unitOnOrder): self
    {
        $this->unitOnOrder = $unitOnOrder;

        return $this;
    }

    public function getDiscontinued(): ?bool
    {
        return $this->discontinued;
    }

    public function setDiscontinued(bool $discontinued): self
    {
        $this->discontinued = $discontinued;

        return $this;
    }

    public function getFlag(): ?bool
    {
        return $this->flag;
    }

    public function setFlag(bool $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * @return Collection|OrderDetail[]
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetail $orderDetail): self
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails[] = $orderDetail;
            $orderDetail->setStock($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): self
    {
        if ($this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->removeElement($orderDetail);
            // set the owning side to null (unless already changed)
            if ($orderDetail->getStock() === $this) {
                $orderDetail->setStock(null);
            }
        }

        return $this;
    }

    public function getProductDetail(): ?ProductDetail
    {
        return $this->productDetail;
    }

    public function setProductDetail(?ProductDetail $productDetail): self
    {
        $this->productDetail = $productDetail;

        return $this;
    }
}
