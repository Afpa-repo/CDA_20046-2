<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 */
class Address
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
    private $addressType;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $addressCountry;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $AddressDistrict;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $AddressPostalCode;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $addressCity;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $addressNumStreet;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $AddressStreet;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $AddressComplement;

    /**
     * @ORM\ManyToOne(targetEntity=Suppliers::class, inversedBy="address")
     */
    private $supplier;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="address")
     */
    private $orders;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="address")
     */
    private $user;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressType(): ?int
    {
        return $this->addressType;
    }

    public function setAddressType(int $addressType): self
    {
        $this->addressType = $addressType;

        return $this;
    }

    public function getAddressCountry(): ?string
    {
        return $this->addressCountry;
    }

    public function setAddressCountry(string $addressCountry): self
    {
        $this->addressCountry = $addressCountry;

        return $this;
    }

    public function getAddressDistrict(): ?string
    {
        return $this->AddressDistrict;
    }

    public function setAddressDistrict(string $AddressDistrict): self
    {
        $this->AddressDistrict = $AddressDistrict;

        return $this;
    }

    public function getAddressPostalCode(): ?string
    {
        return $this->AddressPostalCode;
    }

    public function setAddressPostalCode(string $AddressPostalCode): self
    {
        $this->AddressPostalCode = $AddressPostalCode;

        return $this;
    }

    public function getAddressCity(): ?string
    {
        return $this->addressCity;
    }

    public function setAddressCity(string $addressCity): self
    {
        $this->addressCity = $addressCity;

        return $this;
    }

    public function getAddressNumStreet(): ?string
    {
        return $this->addressNumStreet;
    }

    public function setAddressNumStreet(string $addressNumStreet): self
    {
        $this->addressNumStreet = $addressNumStreet;

        return $this;
    }

    public function getAddressStreet(): ?string
    {
        return $this->AddressStreet;
    }

    public function setAddressStreet(string $AddressStreet): self
    {
        $this->AddressStreet = $AddressStreet;

        return $this;
    }

    public function getAddressComplement(): ?string
    {
        return $this->AddressComplement;
    }

    public function setAddressComplement(?string $AddressComplement): self
    {
        $this->AddressComplement = $AddressComplement;

        return $this;
    }

    public function getSupplier(): ?suppliers
    {
        return $this->supplier;
    }

    public function setSupplier(?suppliers $supplier): self
    {
        $this->supplier = $supplier;

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
            $order->setAddress($this);
        }

        return $this;
    }

    public function removeOrder(order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getAddress() === $this) {
                $order->setAddress(null);
            }
        }

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
