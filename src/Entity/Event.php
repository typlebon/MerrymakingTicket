<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
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
    private $name_event;

    /**
     * @ORM\Column(type="text")
     */
    private $short_description_event;

    /**
     * @ORM\Column(type="text")
     */
    private $long_description_event;

    /**
     * @ORM\Column(type="integer")
     */
    private $ref_provider_event;

    /**
     * @ORM\Column(type="float")
     */
    private $purchase_price_event;

    /**
     * @ORM\Column(type="date")
     */
    private $start_date_event;

    /**
     * @ORM\Column(type="date")
     */
    private $end_date_event;

    /**
     * @ORM\Column(type="integer")
     */
    private $festival_place_event;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEvent(): ?string
    {
        return $this->name_event;
    }

    public function setNameEvent(string $name_event): self
    {
        $this->name_event = $name_event;

        return $this;
    }

    public function getShortDescriptionEvent(): ?string
    {
        return $this->short_description_event;
    }

    public function setShortDescriptionEvent(string $short_description_event): self
    {
        $this->short_description_event = $short_description_event;

        return $this;
    }

    public function getLongDescriptionEvent(): ?string
    {
        return $this->long_description_event;
    }

    public function setLongDescriptionEvent(string $long_description_event): self
    {
        $this->long_description_event = $long_description_event;

        return $this;
    }

    public function getRefProviderEvent(): ?int
    {
        return $this->ref_provider_event;
    }

    public function setRefProviderEvent(int $ref_provider_event): self
    {
        $this->ref_provider_event = $ref_provider_event;

        return $this;
    }

    public function getPurchasePriceEvent(): ?float
    {
        return $this->purchase_price_event;
    }
    
    public function setPurchasePriceEvent(float $purchase_price_event): self
    {
        $this->purchase_price_event = $purchase_price_event;
        
        return $this;
    }

    public function getStartDateEvent(): ?\DateTimeInterface
    {
        return $this->start_date_event;
    }

    public function setStartDateEvent(\DateTimeInterface $start_date_event): self
    {
        $this->start_date_event = $start_date_event;

        return $this;
    }

    public function getEndDateEvent(): ?\DateTimeInterface
    {
        return $this->end_date_event;
    }

    public function setEndDateEvent(\DateTimeInterface $end_date_event): self
    {
        $this->end_date_event = $end_date_event;

        return $this;
    }

    public function getFestivalPlaceEvent(): ?int
    {
        return $this->festival_place_event;
    }

    public function setFestivalPlaceEvent(int $festival_place_event): self
    {
        $this->festival_place_event = $festival_place_event;

        return $this;
    }
}
