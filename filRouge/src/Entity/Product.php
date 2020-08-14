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
     * @ORM\Column(type="integer")
     */
    private $proStockAle;

    /**
     * @ORM\Column(type="integer")
     */
    private $proUnitPrice;

    /**
     * @ORM\Column(type="integer")
     */
    private $ProUnitStockPhy;

    /**
     * @ORM\Column(type="integer")
     */
    private $proUnitOnOrder;

    /**
     * @ORM\Column(type="integer")
     */
    private $proDiscontinued;

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
     * @ORM\ManyToOne(targetEntity=Material::class, inversedBy="products")
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity=Format::class, inversedBy="products")
     */
    private $format;



    /**
     * @ORM\OneToMany(targetEntity=OrderDetail::class, mappedBy="product")
     */
    private $orderDetails;

    /**
     * @ORM\ManyToOne(targetEntity=Picture::class, inversedBy="products")
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity=Theme::class, inversedBy="products")
     */
    private $theme;

    public function __construct()
    {
        $this->theme = new ArrayCollection();
        $this->orderDetails = new ArrayCollection();
        $this->Picture = new ArrayCollection();
    }

    public function getProPicture(): ?object
    {
        return $this->proPicture;
    }

    public function setProPicture(object $proPicture): self
    {
        $this->proName = $proPicture;

        return $this;
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

    public function getProStockAle(): ?int
    {
        return $this->proStockAle;
    }

    public function setProStockAle(int $proStockAle): self
    {
        $this->proStockAle = $proStockAle;

        return $this;
    }

    public function getProUnitPrice(): ?int
    {
        return $this->proUnitPrice;
    }

    public function setProUnitPrice(int $proUnitPrice): self
    {
        $this->proUnitPrice = $proUnitPrice;

        return $this;
    }

    public function getProUnitStockPhy(): ?int
    {
        return $this->ProUnitStockPhy;
    }

    public function setProUnitStockPhy(int $ProUnitStockPhy): self
    {
        $this->ProUnitStockPhy = $ProUnitStockPhy;

        return $this;
    }

    public function getProUnitOnOrder(): ?int
    {
        return $this->proUnitOnOrder;
    }

    public function setProUnitOnOrder(int $proUnitOnOrder): self
    {
        $this->proUnitOnOrder = $proUnitOnOrder;

        return $this;
    }

    public function getProDiscontinued(): ?int
    {
        return $this->proDiscontinued;
    }

    public function setProDiscontinued(int $proDiscontinued): self
    {
        $this->proDiscontinued = $proDiscontinued;

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

    public function getMaterial(): ?material
    {
        return $this->material;
    }

    public function setMaterial(?material $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getFormat(): ?format
    {
        return $this->format;
    }

    public function setFormat(?format $format): self
    {
        $this->format = $format;

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
            $picture->setProduct($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->Picture->contains($picture)) {
            $this->Picture->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getProduct() === $this) {
                $picture->setProduct(null);
            }
        }

        return $this;
    }

    public function setPicture(?picture $picture): self
    {
        $this->picture = $picture;

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
}
