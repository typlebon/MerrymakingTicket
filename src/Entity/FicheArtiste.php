<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FicheArtisteRepository")
 */
class FicheArtiste
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name_artiste;

    /**
     * @ORM\Column(type="text")
     */
    private $description_artiste;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getname_artiste(): ?string
    {
        return $this->name_artiste;
    }

    public function setNameArtiste(string $name_artiste): self
    {
        $this->name_artiste = $name_artiste;

        return $this;
    }

    public function getdescription_artiste(): ?string
    {
        return $this->description_artiste;
    }

    public function setDescriptionArtiste(string $description_artiste): self
    {
        $this->description_artiste = $description_artiste;

        return $this;
    }
}
