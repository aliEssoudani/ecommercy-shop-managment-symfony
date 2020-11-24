<?php

namespace App\Entity;

use App\Repository\StoresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=StoresRepository::class)
 */
class Stores
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
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $login;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Employes::class, mappedBy="stores")
     */
    private $employes;

    /**
     * @ORM\OneToMany(targetEntity=Products::class, mappedBy="stores")
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="stores")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity=Categories::class, mappedBy="stores")
     */
    private $categories;

    /**
     * @ORM\OneToMany(targetEntity=Expenses::class, mappedBy="stores")
     */
    private $expenses;

    /**
     * @ORM\ManyToOne(targetEntity=Managers::class, inversedBy="stores")
     */
    private $managers;

    /**
     * @ORM\OneToOne(targetEntity=AttendenceConfiguration::class, cascade={"persist", "remove"})
     */
    private $atendanceConfiguration;

    public function __construct()
    {
        $this->employes = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->orders = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->expenses = new ArrayCollection();
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

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|Employes[]
     */
    public function getEmployes(): Collection
    {
        return $this->employes;
    }

    public function addEmploye(Employes $employe): self
    {
        if (!$this->employes->contains($employe)) {
            $this->employes[] = $employe;
            $employe->setStores($this);
        }

        return $this;
    }

    public function removeEmploye(Employes $employe): self
    {
        if ($this->employes->removeElement($employe)) {
            // set the owning side to null (unless already changed)
            if ($employe->getStores() === $this) {
                $employe->setStores(null);
            }
        }

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
            $product->setStores($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getStores() === $this) {
                $product->setStores(null);
            }
        }

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
            $order->setStores($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getStores() === $this) {
                $order->setStores(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Categories[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setStores($this);
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getStores() === $this) {
                $category->setStores(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Expenses[]
     */
    public function getExpenses(): Collection
    {
        return $this->expenses;
    }

    public function addExpense(Expenses $expense): self
    {
        if (!$this->expenses->contains($expense)) {
            $this->expenses[] = $expense;
            $expense->setStores($this);
        }

        return $this;
    }

    public function removeExpense(Expenses $expense): self
    {
        if ($this->expenses->removeElement($expense)) {
            // set the owning side to null (unless already changed)
            if ($expense->getStores() === $this) {
                $expense->setStores(null);
            }
        }

        return $this;
    }

    public function getManagers(): ?Managers
    {
        return $this->managers;
    }

    public function setManagers(?Managers $managers): self
    {
        $this->managers = $managers;

        return $this;
    }

    public function getAtendanceConfiguration(): ?AttendenceConfiguration
    {
        return $this->atendanceConfiguration;
    }

    public function setAtendanceConfiguration(?AttendenceConfiguration $atendanceConfiguration): self
    {
        $this->atendanceConfiguration = $atendanceConfiguration;

        return $this;
    }
    public function __toString(){
        return $this->getName();
    }

}
