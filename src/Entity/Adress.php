<?php

namespace App\Entity;

use App\Repository\AdressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdressRepository::class)]
class Adress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $street = null;

 /*   #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $city_code = null;*/

    #[ORM\Column(nullable: true)]
    private ?int $latitude = null;

    #[ORM\Column(nullable: true)]
    private ?int $longitude = null;

    #[ORM\ManyToOne(inversedBy: 'adresses')]
    private ?City $City = null;

    #[ORM\OneToOne(mappedBy: 'Adress', cascade: ['persist', 'remove'])]
    private ?Place $Place = null;

    #[ORM\OneToMany(mappedBy: 'adress', targetEntity: Event::class)]
    private Collection $Event;

    public function __construct()
    {
        $this->Event = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

//    public function getCity(): ?string
//    {
//        return $this->city;
//    }
//
//    public function setCity(string $city): static
//    {
//        $this->city = $city;
//
//        return $this;
//    }
//
//    public function getCityCode(): ?string
//    {
//        return $this->city_code;
//    }
//
//    public function setCityCode(string $city_code): static
//    {
//        $this->city_code = $city_code;
//
//        return $this;
//    }

    public function getLatitude(): ?int
    {
        return $this->latitude;
    }

    public function setLatitude(?int $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?int
    {
        return $this->longitude;
    }

    public function setLongitude(?int $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->Place;
    }

    public function setPlace(?Place $Place): static
    {
        // unset the owning side of the relation if necessary
        if ($Place === null && $this->Place !== null) {
            $this->Place->setAdress(null);
        }

        // set the owning side of the relation if necessary
        if ($Place !== null && $Place->getAdress() !== $this) {
            $Place->setAdress($this);
        }

        $this->Place = $Place;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvent(): Collection
    {
        return $this->Event;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->Event->contains($event)) {
            $this->Event->add($event);
            $event->setAdress($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->Event->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getAdress() === $this) {
                $event->setAdress(null);
            }
        }

        return $this;
    }
}
