<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 */
class Picture
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Suppliers::class, mappedBy="picture")
     */
    private $suppliers;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="picture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;


    public function __construct()
    {
        $this->suppliers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $link): self
    {
        $this->name = $link;

        return $this;
    }

    /**
     * @return Collection|Suppliers[]
     */
    public function getSuppliers(): Collection
    {
        return $this->suppliers;
    }

    public function addSupplier(Suppliers $supplier): self
    {
        if (!$this->suppliers->contains($supplier)) {
            $this->suppliers[] = $supplier;
            $supplier->setPicture($this);
        }

        return $this;
    }

    public function removeSupplier(Suppliers $supplier): self
    {
        if ($this->suppliers->contains($supplier)) {
            $this->suppliers->removeElement($supplier);
            // set the owning side to null (unless already changed)
            if ($supplier->getPicture() === $this) {
                $supplier->setPicture(null);
            }
        }

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    


}
