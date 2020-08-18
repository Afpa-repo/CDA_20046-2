<?php

namespace App\Entity;

use App\Repository\ProductDetailRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductDetailRepository::class)
 */
class ProductDetail
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
    private $materialId;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $materialName;

    /**
     * @ORM\Column(type="integer")
     */
    private $formatId;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $formatName;

    /**
     * @ORM\Column(type="integer")
     */
    private $unitPrice;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="productDetail")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="productDetail")
     */
    private $stocks;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->stocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMaterialId(): ?int
    {
        return $this->materialId;
    }

    public function setMaterialId(int $materialId): self
    {
        $this->materialId = $materialId;

        return $this;
    }

    public function getMaterialName(): ?string
    {
        return $this->materialName;
    }

    public function setMaterialName(string $materialName): self
    {
        $this->materialName = $materialName;

        return $this;
    }

    public function getFormatId(): ?int
    {
        return $this->formatId;
    }

    public function setFormatId(int $formatId): self
    {
        $this->formatId = $formatId;

        return $this;
    }

    public function getFormatName(): ?string
    {
        return $this->formatName;
    }

    public function setFormatName(string $formatName): self
    {
        $this->formatName = $formatName;

        return $this;
    }

    public function getUnitPrice(): ?int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setProductDetail($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getProductDetail() === $this) {
                $product->setProductDetail(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setProductDetail($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->contains($stock)) {
            $this->stocks->removeElement($stock);
            // set the owning side to null (unless already changed)
            if ($stock->getProductDetail() === $this) {
                $stock->setProductDetail(null);
            }
        }

        return $this;
    }
}
