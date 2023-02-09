<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehiculeRepository::class)
 */
class Vehicule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=MarqueVehicule::class)
     */
    private $marque_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matricule;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_acq;

    /**
     * @ORM\ManyToOne(targetEntity=TypeVehicule::class)
     */
    private $type_vehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarqueId(): ?MarqueVehicule
    {
        return $this->marque_id;
    }

    public function setMarqueId(?MarqueVehicule $marque_id): self
    {
        $this->marque_id = $marque_id;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getDateAcq(): ?\DateTimeInterface
    {
        return $this->date_acq;
    }

    public function setDateAcq(?\DateTimeInterface $date_acq): self
    {
        $this->date_acq = $date_acq;

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
}
