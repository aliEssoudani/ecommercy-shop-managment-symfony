<?php

namespace App\Entity;

use App\Repository\EmployesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployesRepository::class)
 */
class Employes
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
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(type="float")
     */
    private $salary;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $zone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\OneToMany(targetEntity=Attendance::class, mappedBy="employes")
     */
    private $attendance;

    /**
     * @ORM\OneToMany(targetEntity=SalaryBonus::class, mappedBy="employes")
     */
    private $salaryBonus;

    /**
     * @ORM\ManyToOne(targetEntity=Stores::class, inversedBy="employes")
     */
    private $stores;

    /**
     * @ORM\OneToMany(targetEntity=Orders::class, mappedBy="employes")
     */
    private $orders;

    public function __construct()
    {
        $this->attendance = new ArrayCollection();
        $this->salaryBonus = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): self
    {
        $this->salary = $salary;

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

    public function getZone(): ?string
    {
        return $this->zone;
    }

    public function setZone(string $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return Collection|Attendance[]
     */
    public function getAttendance(): Collection
    {
        return $this->attendance;
    }

    public function addAttendance(Attendance $attendance): self
    {
        if (!$this->attendance->contains($attendance)) {
            $this->attendance[] = $attendance;
            $attendance->setEmployes($this);
        }

        return $this;
    }

    public function removeAttendance(Attendance $attendance): self
    {
        if ($this->attendance->removeElement($attendance)) {
            // set the owning side to null (unless already changed)
            if ($attendance->getEmployes() === $this) {
                $attendance->setEmployes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SalaryBonus[]
     */
    public function getSalaryBonus(): Collection
    {
        return $this->salaryBonus;
    }

    public function addSalaryBonu(SalaryBonus $salaryBonu): self
    {
        if (!$this->salaryBonus->contains($salaryBonu)) {
            $this->salaryBonus[] = $salaryBonu;
            $salaryBonu->setEmployes($this);
        }

        return $this;
    }

    public function removeSalaryBonu(SalaryBonus $salaryBonu): self
    {
        if ($this->salaryBonus->removeElement($salaryBonu)) {
            // set the owning side to null (unless already changed)
            if ($salaryBonu->getEmployes() === $this) {
                $salaryBonu->setEmployes(null);
            }
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
            $order->setEmployes($this);
        }

        return $this;
    }

    public function removeOrder(Orders $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getEmployes() === $this) {
                $order->setEmployes(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return $this->getFullName();
    }
}
