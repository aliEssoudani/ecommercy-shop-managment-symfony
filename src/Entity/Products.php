<?php

namespace App\Entity;

use Symfony\Component\Form\FormTypeInterface;
use App\Repository\ProductsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Form\ProductsType;


/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 */
class Products
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="products")
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=Orders::class, inversedBy="products")
     */
    private $orders;

    /**
     * @ORM\ManyToOne(targetEntity=Stores::class, inversedBy="products")
     */
    private $stores;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection|Orders[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Orders $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        $this->orders->removeElement($order);

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
    public function __toString(){
        return $this->getName();
    }
}
