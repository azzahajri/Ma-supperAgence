<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[UniqueEntity('title')]

class Property
{
    const HEAT = [
      0 => 'Electrique',
      1 => 'Gas',
      2 => 'Mecanique'
    ];
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id ;

    #[ORM\Column(length: 255), Assert\Length(min: 4, max: 255)]
    private ?string $title ;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description ;

    #[ORM\Column, Assert\Range(min: 10, max: 400)]
    private ?int $surface ;

    #[ORM\Column]
    private ?int $rooms ;

    #[ORM\Column]
    private ?int $bedrooms ;

    #[ORM\Column]
    private ?int $floor ;

    #[ORM\Column]
    private ?int $price ;

    #[ORM\Column]
    private ?int $heat ;

    #[ORM\Column(length: 255)]
    private ?string $city ;

    #[ORM\Column(length: 255)]
    private ?string $address ;

    #[ORM\Column(length: 255), Assert\Regex("/^[0-9]{4}$/")]
    private ?string $postal_code;

    #[ORM\Column]
    private ?bool $sold = false ;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at ;
     public function __construct()
     {
         $this->created_at = new \DateTimeImmutable();
     }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
    public function getFormattedPrice(): string
    {
        return number_format($this->price,0,'','');
    }

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    public function setHeat(int $heat): self
    {
        $this->heat = $heat;

        return $this;
    }
    public function getHeatType(): string
    {
        return self::HEAT[$this->heat];
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function isSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
