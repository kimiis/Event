<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToOne(inversedBy: 'place', cascade: ['persist', 'remove'])]
    private ?Adress $Adress = null;

    #[ORM\ManyToOne(inversedBy: 'Place')]
    private ?City $city = null;

    #[ORM\OneToMany(mappedBy: 'Place', targetEntity: Event::class)]
    private Collection $events;


    public function __construct()
    {
        $this->events = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name . ", " . $this->street. " - " . $this->city->getName();
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

    public function getAdress(): ?Adress
    {
        return $this->Adress;
    }

    public function setAdress(?Adress $Adress): static
    {
        $this->Adress = $Adress;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): static
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setPlace($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getPlace() === $this) {
                $event->setPlace(null);
            }
        }

        return $this;
    }


}
