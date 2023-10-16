<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\GreaterThan("today UTC")]
    private ?\DateTimeInterface $dateD = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\GreaterThan("today UTC")]
    private ?\DateTimeInterface $limiteDate = null;

    #[ORM\Column]
    private ?int $nbMaxInsc = null;

    #[ORM\Column(length: 255)]
    private ?string $infosEvent = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?Status $status = null;

    #[ORM\Column(length: 255)]
    private ?string $Address = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $time = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Campus $campus = null;

    public function __construct()
    {

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDateD(): ?\DateTimeInterface
    {
        return $this->dateD;
    }

    public function setDateD(\DateTimeInterface $dateD): static
    {
        $this->dateD = $dateD;

        return $this;
    }


    public function getLimiteDate(): ?\DateTimeInterface
    {
        return $this->limiteDate;
    }

    public function setLimiteDate(\DateTimeInterface $limiteDate): static
    {
        $this->limiteDate = $limiteDate;

        return $this;
    }

    public function getNbMaxInsc(): ?int
    {
        return $this->nbMaxInsc;
    }

    public function setNbMaxInsc(int $nbMaxInsc): static
    {
        $this->nbMaxInsc = $nbMaxInsc;

        return $this;
    }

    public function getInfosEvent(): ?string
    {
        return $this->infosEvent;
    }

    public function setInfosEvent(string $infosEvent): static
    {
        $this->infosEvent = $infosEvent;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): static
    {
        $this->Address = $Address;

        return $this;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    public function setCampus(?Campus $campus): static
    {
        $this->campus = $campus;

        return $this;
    }

}
