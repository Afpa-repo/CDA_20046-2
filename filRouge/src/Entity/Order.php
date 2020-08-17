<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $orderDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $orderDateShipping;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderType;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderShippingCost;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetail::class, mappedBy="orders")
     */
    private $detail;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="orders")
     */
    private $address;

    public function __construct()
    {
        $this->detail = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getOrderDateShipping(): ?\DateTimeInterface
    {
        return $this->orderDateShipping;
    }

    public function setOrderDateShipping(?\DateTimeInterface $orderDateShipping): self
    {
        $this->orderDateShipping = $orderDateShipping;

        return $this;
    }

    public function getOrderType(): ?int
    {
        return $this->orderType;
    }

    public function setOrderType(int $orderType): self
    {
        $this->orderType = $orderType;

        return $this;
    }

    public function getOrderShippingCost(): ?int
    {
        return $this->orderShippingCost;
    }

    public function setOrderShippingCost(int $orderShippingCost): self
    {
        $this->orderShippingCost = $orderShippingCost;

        return $this;
    }

    /**
     * @return Collection|orderdetail[]
     */
    public function getDetail(): Collection
    {
        return $this->detail;
    }

    public function addDetail(orderdetail $detail): self
    {
        if (!$this->detail->contains($detail)) {
            $this->detail[] = $detail;
            $detail->setOrders($this);
        }

        return $this;
    }

    public function removeDetail(orderdetail $detail): self
    {
        if ($this->detail->contains($detail)) {
            $this->detail->removeElement($detail);
            // set the owning side to null (unless already changed)
            if ($detail->getOrders() === $this) {
                $detail->setOrders(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }
}
