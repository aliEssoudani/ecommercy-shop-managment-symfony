<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersRepository::class)
 */
class Orders
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $total;

    /**
     * @ORM\Column(type="float")
     */
    private $reductionRatio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="float")
     */
    private $finalTotal;

    /**
     * @ORM\ManyToOne(targetEntity=Employes::class, inversedBy="orders")
     */
    private $employes;

    /**
     * @ORM\ManyToMany(targetEntity=Products::class, mappedBy="orders")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity=Stores::class, inversedBy="orders")
     */
    private $stores;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getReductionRatio(): ?float
    {
        return $this->reductionRatio;
    }

    public function setReductionRatio(float $reductionRatio): self
    {
        $this->reductionRatio = $reductionRatio;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getFinalTotal(): ?float
    {
        return $this->finalTotal;
    }

    public function setFinalTotal(float $finalTotal): self
    {
        $this->finalTotal = $finalTotal;

        return $this;
    }

    public function getEmployes(): ?Employes
    {
        return $this->employes;
    }

    public function setEmployes(?Employes $employes): self
    {
        $this->employes = $employes;

        return $this;
    }

    /**
     * @return Collection|Products[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addOrder($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            $product->removeOrder($this);
        }

        return $this;
    }

    public function getStores(): ?Stores
    {
        return $this->stores;
    }

    public function setStores(?Stores $stores): self
    {
        $this->stores = $stores;

        return $this;
    }

}
