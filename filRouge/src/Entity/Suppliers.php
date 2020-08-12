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
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="suppliers")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="supplier")
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity=Picture::class, inversedBy="suppliers")
     */
    private $picture;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->address = new ArrayCollection();
        $this->Picture = new ArrayCollection();
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

    /**
     * @return Collection|order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setSuppliers($this);
        }

        return $this;
    }

    public function removeOrder(order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getSuppliers() === $this) {
                $order->setSuppliers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddress(): Collection
    {
        return $this->address;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->address->contains($address)) {
            $this->address[] = $address;
            $address->setSupplier($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->address->contains($address)) {
            $this->address->removeElement($address);
            // set the owning side to null (unless already changed)
            if ($address->getSupplier() === $this) {
                $address->setSupplier(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPicture(): Collection
    {
        return $this->Picture;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->Picture->contains($picture)) {
            $this->Picture[] = $picture;
            $picture->setSuppliers($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->Picture->contains($picture)) {
            $this->Picture->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getSuppliers() === $this) {
                $picture->setSuppliers(null);
            }
        }

        return $this;
    }

    public function setPicture(?picture $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
