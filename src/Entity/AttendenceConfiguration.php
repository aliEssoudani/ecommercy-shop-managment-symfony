<?php

namespace App\Entity;

use App\Repository\AttendenceConfigurationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttendenceConfigurationRepository::class)
 */
class AttendenceConfiguration
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
    private $bonusAmount;

    /**
     * @ORM\Column(type="float")
     */
    private $malusAmount;

    /**
     * @ORM\Column(type="time")
     */
    private $checkInTime;

    /**
     * @ORM\Column(type="time")
     */
    private $checkOutTime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBonusAmount(): ?float
    {
        return $this->bonusAmount;
    }

    public function setBonusAmount(float $bonusAmount): self
    {
        $this->bonusAmount = $bonusAmount;

        return $this;
    }

    public function getMalusAmount(): ?float
    {
        return $this->malusAmount;
    }

    public function setMalusAmount(float $malusAmount): self
    {
        $this->malusAmount = $malusAmount;

        return $this;
    }

    public function getCheckInTime(): ?\DateTimeInterface
    {
        return $this->checkInTime;
    }

    public function setCheckInTime(\DateTimeInterface $checkInTime): self
    {
        $this->checkInTime = $checkInTime;

        return $this;
    }

    public function getCheckOutTime(): ?\DateTimeInterface
    {
        return $this->checkOutTime;
    }

    public function setCheckOutTime(\DateTimeInterface $checkOutTime): self
    {
        $this->checkOutTime = $checkOutTime;

        return $this;
    }
}
