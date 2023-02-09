<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestationRepository::class)
 */
class Prestation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=TypePrestation::class)
     */
    private $type_prestation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $observation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $conducteur;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tarif_prestation;

    /**
     * @ORM\ManyToOne(targetEntity=TypeVehicule::class)
     */
    private $type_vehicule;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nuit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weekend;

    /**
     * @ORM\ManyToOne(targetEntity=Zone::class)
     */
    private $zone_id;

    /**
     * @ORM\OneToMany(targetEntity=FactureDet::class, mappedBy="prestation")
     */
    private $factureDets;

    public function __construct()
    {
        $this->factureDets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypePrestation(): ?TypePrestation
    {
        return $this->type_prestation;
    }

    public function setTypePrestation(?TypePrestation $type_prestation): self
    {
        $this->type_prestation = $type_prestation;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getConducteur(): ?int
    {
        return $this->conducteur;
    }

    public function setConducteur(?int $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    public function getTarifPrestation(): ?float
    {
        return $this->tarif_prestation;
    }

    public function setTarifPrestation(?float $tarif_prestation): self
    {
        $this->tarif_prestation = $tarif_prestation;

        return $this;
    }

    public function getTypeVehicule(): ?TypeVehicule
    {
        return $this->type_vehicule;
    }

    public function setTypeVehicule(?TypeVehicule $type_vehicule): self
    {
        $this->type_vehicule = $type_vehicule;

        return $this;
    }

    public function getKilometrage(): ?int
    {
        return $this->kilometrage;
    }

    public function setKilometrage(?int $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getNuit(): ?int
    {
        return $this->nuit;
    }

    public function setNuit(?int $nuit): self
    {
        $this->nuit = $nuit;

        return $this;
    }

    public function getWeekend(): ?int
    {
        return $this->weekend;
    }

    public function setWeekend(?int $weekend): self
    {
        $this->weekend = $weekend;

        return $this;
    }

    public function getZoneId(): ?Zone
    {
        return $this->zone_id;
    }

    public function setZoneId(?Zone $zone_id): self
    {
        $this->zone_id = $zone_id;

        return $this;
    }

    /**
     * @return Collection<int, FactureDet>
     */
    public function getFactureDets(): Collection
    {
        return $this->factureDets;
    }

    public function addFactureDet(FactureDet $factureDet): self
    {
        if (!$this->factureDets->contains($factureDet)) {
            $this->factureDets[] = $factureDet;
            $factureDet->setPrestation($this);
        }

        return $this;
    }

    public function removeFactureDet(FactureDet $factureDet): self
    {
        if ($this->factureDets->removeElement($factureDet)) {
            // set the owning side to null (unless already changed)
            if ($factureDet->getPrestation() === $this) {
                $factureDet->setPrestation(null);
            }
        }

        return $this;
    }
}
