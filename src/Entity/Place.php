<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlaceRepository")
 */
class Place
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $artist;

    /**
     * @ORM\Column(type="integer")
     */
    private $remaining_quantity;

    /**
     * @ORM\Column(type="date")
     */
    private $availibility;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getArtist(): ?string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    public function getRemainingQuantity(): ?int
    {
        return $this->remaining_quantity;
    }

    public function setRemainingQuantity(int $remaining_quantity): self
    {
        $this->remaining_quantity = $remaining_quantity;

        return $this;
    }

    public function getAvailibility(): ?\DateTimeInterface
    {
        return $this->availibility;
    }

    public function setAvailibility(\DateTimeInterface $availibility): self
    {
        $this->availibility = $availibility;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
