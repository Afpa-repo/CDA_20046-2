<?php

namespace App\Entity;

use App\Repository\SuppliersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuppliersRepository::class)
 */
class Suppliers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $suppliCompanyName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $suppliMail;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $SuppliPhone;

    /**
     * @ORM\ManyToOne(targetEntity=Address::class, inversedBy="suppliers")
     */
    private $adress;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetail::class, mappedBy="supplier")
     */
    private $orderDetails;

    /**
     * @ORM\ManyToOne(targetEntity=Picture::class, inversedBy="suppliers")
     */
    private $picture;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->address = new ArrayCollection();
        $this->orderDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuppliCompanyName(): ?string
    {
        return $this->suppliCompanyName;
    }

    public function setSuppliCompanyName(string $suppliCompanyName): self
    {
        $this->suppliCompanyName = $suppliCompanyName;

        return $this;
    }

    public function getSuppliMail(): ?string
    {
        return $this->suppliMail;
    }

    public function setSuppliMail(string $suppliMail): self
    {
        $this->suppliMail = $suppliMail;

        return $this;
    }

    public function getSuppliPhone(): ?string
    {
        return $this->SuppliPhone;
    }

    public function setSuppliPhone(string $SuppliPhone): self
    {
        $this->SuppliPhone = $SuppliPhone;

        return $this;
    }

    public function getAdress(): ?Address
    {
        return $this->adress;
    }

    public function setAdress(?Address $adress): self
    {
        $this->adress = $adress;

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
            $orderDetail->setSupplier($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): self
    {
        if ($this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->removeElement($orderDetail);
            // set the owning side to null (unless already changed)
            if ($orderDetail->getSupplier() === $this) {
                $orderDetail->setSupplier(null);
            }
        }

        return $this;
    }

    public function getPicture(): ?Picture
    {
        return $this->picture;
    }

    public function setPicture(?Picture $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
