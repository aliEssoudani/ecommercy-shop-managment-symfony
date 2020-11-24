<?php

namespace App\Entity;

use App\Repository\SalaryBonusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SalaryBonusRepository::class)
 */
class SalaryBonus
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
    private $sum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motivation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreationDate;

    /**
     * @ORM\ManyToOne(targetEntity=Employes::class, inversedBy="salaryBonus")
     */
    private $employes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSum(): ?float
    {
        return $this->sum;
    }

    public function setSum(float $sum): self
    {
        $this->sum = $sum;

        return $this;
    }

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(string $motivation): self
    {
        $this->motivation = $motivation;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->CreationDate;
    }

    public function setCreationDate(\DateTimeInterface $CreationDate): self
    {
        $this->CreationDate = $CreationDate;

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
}
