<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role
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
    private $nom_role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRole(): ?string
    {
        return $this->nom_role;
    }

    public function setNomRole(string $nom_role): self
    {
        $this->nom_role = $nom_role;

        return $this;
    }
}
