<?php

namespace App\Entity;

use App\Repository\AttendanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttendanceRepository::class)
 */
class Attendance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkIn;

    /**
     * @ORM\Column(type="datetime")
     */
    private $checkOut;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isValide;

    /**
     * @ORM\ManyToOne(targetEntity=Employes::class, inversedBy="attendance")
     */
    private $employes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheckIn(): ?\DateTimeInterface
    {
        return $this->checkIn;
    }

    public function setCheckIn(\DateTimeInterface $checkIn): self
    {
        $this->checkIn = $checkIn;

        return $this;
    }

    public function getCheckOut(): ?\DateTimeInterface
    {
        return $this->checkOut;
    }

    public function setCheckOut(\DateTimeInterface $checkOut): self
    {
        $this->checkOut = $checkOut;

        return $this;
    }

    public function getIsValide(): ?bool
    {
        return $this->isValide;
    }

    public function setIsValide(bool $isValide): self
    {
        $this->isValide = $isValide;

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
