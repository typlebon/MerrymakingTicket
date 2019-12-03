<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeEventRepository")
 */
class TypeEvent
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
    private $name_type_event;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameTypeEvent(): ?string
    {
        return $this->name_type_event;
    }

    public function setNameTypeEvent(string $name_type_event): self
    {
        $this->name_type_event = $name_type_event;

        return $this;
    }
}
