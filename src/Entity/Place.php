<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

    #[ORM\Column(nullable: true)]
    private ?int $Latitude = null;

    #[ORM\Column(nullable: true)]
    private ?int $Longitude = null;

    #[ORM\ManyToOne(inversedBy: 'places')]
    private ?City $Place = null;

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

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): static
    {
        $this->street = $street;

        return $this;
    }

    public function getLatitude(): ?int
    {
        return $this->Latitude;
    }

    public function setLatitude(?int $Latitude): static
    {
        $this->Latitude = $Latitude;

        return $this;
    }

    public function getLongitude(): ?int
    {
        return $this->Longitude;
    }

    public function setLongitude(?int $Longitude): static
    {
        $this->Longitude = $Longitude;

        return $this;
    }

    public function getPlace(): ?City
    {
        return $this->Place;
    }

    public function setPlace(?City $Place): static
    {
        $this->Place = $Place;

        return $this;
    }
}
