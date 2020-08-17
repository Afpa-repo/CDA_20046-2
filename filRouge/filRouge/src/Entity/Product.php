<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $proName;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $proNote;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $proLib;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $proDescription;

    /**
     * @ORM\OneToMany(targetEntity=OrderDetail::class, mappedBy="product")
     */
    private $orderDetails;

    /**
     * @ORM\ManyToMany(targetEntity=Theme::class, inversedBy="products")
     */
    private $theme;

    /**
     * @ORM\ManyToOne(targetEntity=Stock::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity=Picture::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $picture;

    public function __construct()
    {
        $this->theme = new ArrayCollection();
        $this->orderDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProName(): ?string
    {
        return $this->proName;
    }

    public function setProName(string $proName): self
    {
        $this->proName = $proName;

        return $this;
    }

    public function getProNote(): ?int
    {
        return $this->proNote;
    }

    public function setProNote(?int $proNote): self
    {
        $this->proNote = $proNote;

        return $this;
    }

    public function getProLib(): ?string
    {
        return $this->proLib;
    }

    public function setProLib(string $proLib): self
    {
        $this->proLib = $proLib;

        return $this;
    }

    public function getProDescription(): ?string
    {
        return $this->proDescription;
    }

    public function setProDescription(string $proDescription): self
    {
        $this->proDescription = $proDescription;

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
            $orderDetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): self
    {
        if ($this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->removeElement($orderDetail);
            // set the owning side to null (unless already changed)
            if ($orderDetail->getProduct() === $this) {
                $orderDetail->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Theme[]
     */
    public function getTheme(): Collection
    {
        return $this->theme;
    }

    public function addTheme(Theme $theme): self
    {
        if (!$this->theme->contains($theme)) {
            $this->theme[] = $theme;
        }

        return $this;
    }

    public function removeTheme(Theme $theme): self
    {
        if ($this->theme->contains($theme)) {
            $this->theme->removeElement($theme);
        }

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
