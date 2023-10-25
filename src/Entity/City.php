<?php

namespace App\Entity;

use App\Repository\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CityRepository::class)]
class City
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $cityCode = null;

    #[ORM\OneToMany(mappedBy: 'City', targetEntity: Adress::class)]
    private Collection $adresses;



    #[ORM\OneToMany(mappedBy: 'City', targetEntity: Event::class)]
    private Collection $events;

    #[ORM\OneToMany(mappedBy: 'City', targetEntity: Place::class)]
    private Collection $places;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();

        $this->events = new ArrayCollection();
        $this->places = new ArrayCollection();
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

    public function getCityCode(): ?int
    {
        return $this->cityCode;
    }

    public function setCityCode(int $cityCode): static
    {
        $this->cityCode = $cityCode;

        return $this;
    }

    /**
     * @return Collection<int, Adress>
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adress $adress): static
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses->add($adress);
            $adress->setCity($this);
        }

        return $this;
    }

    public function removeAdress(Adress $adress): static
    {
        if ($this->adresses->removeElement($adress)) {
            // set the owning side to null (unless already changed)
            if ($adress->getCity() === $this) {
                $adress->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Place>
     */
    public function getPlace(): Collection
    {
        return $this->Place;
    }

    public function addPlace(Place $place): static
    {
        if (!$this->Place->contains($place)) {
            $this->Place->add($place);
            $place->setCity($this);
        }

        return $this;
    }

    public function removePlace(Place $place): static
    {
        if ($this->Place->removeElement($place)) {
            // set the owning side to null (unless already changed)
            if ($place->getCity() === $this) {
                $place->setCity(null);
            }
        }

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
            $event->setCity($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getCity() === $this) {
                $event->setCity(null);
            }
        }

        return $this;
    }



}
