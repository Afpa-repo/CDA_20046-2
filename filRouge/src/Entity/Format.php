<?php

namespace App\Entity;

use App\Repository\FormatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormatRepository::class)
 */
class Format
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
    private $formatName;
    
    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="format")
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

    public function getFormatName(): ?string
    {
        return $this->formatName;
    }

    public function setFormatName(string $formatName): self
    {
        $this->formatName = $formatName;

        return $this;
    }

    public function __toString() {
        return $this->formatName;
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
            $stock->setFormat($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->contains($stock)) {
            $this->stocks->removeElement($stock);
            // set the owning side to null (unless already changed)
            if ($stock->getFormat() === $this) {
                $stock->setFormat(null);
            }
        }

        return $this;
    }
}
