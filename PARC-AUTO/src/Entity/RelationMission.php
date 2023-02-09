<?php

namespace App\Entity;

use App\Entity\RelationMission;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RelationMissionRepository;

/**
 * @ORM\Entity(repositoryClass=RelationMissionRepository::class)
 */
class RelationMission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=MissionCab::class)
     */
    private $mission_id;

    /**
     * @ORM\ManyToOne(targetEntity=Prestation::class)
     */
    private $prestation_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $is_initier;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $is_valider;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $km_depart;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dm_retour;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $is_suspended;

    /**
     * @ORM\ManyToOne(targetEntity=Conducteur::class)
     */
    private $conducteur_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $jawaz;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $frais_getion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $carburant;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $remise;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMissionId(): ?MissionCab
    {
        return $this->mission_id;
    }

    public function setMissionId(?MissionCab $mission_id): self
    {
        $this->mission_id = $mission_id;

        return $this;
    }

    public function getPrestationId(): ?Prestation
    {
        return $this->prestation_id;
    }

    public function setPrestationId(?Prestation $prestation_id): self
    {
        $this->prestation_id = $prestation_id;

        return $this;
    }

    public function getIsInitier(): ?int
    {
        return $this->is_initier;
    }

    public function setIsInitier(?int $is_initier): self
    {
        $this->is_initier = $is_initier;

        return $this;
    }

    public function getIsValider(): ?int
    {
        return $this->is_valider;
    }

    public function setIsValider(?int $is_valider): self
    {
        $this->is_valider = $is_valider;

        return $this;
    }

    public function getKmDepart(): ?float
    {
        return $this->km_depart;
    }

    public function setKmDepart(?float $km_depart): self
    {
        $this->km_depart = $km_depart;

        return $this;
    }

    public function getDmRetour(): ?float
    {
        return $this->dm_retour;
    }

    public function setDmRetour(?float $dm_retour): self
    {
        $this->dm_retour = $dm_retour;

        return $this;
    }

    public function getIsSuspended(): ?int
    {
        return $this->is_suspended;
    }

    public function setIsSuspended(?int $is_suspended): self
    {
        $this->is_suspended = $is_suspended;

        return $this;
    }

    public function getConducteurId(): ?Conducteur
    {
        return $this->conducteur_id;
    }

    public function setConducteurId(?Conducteur $conducteur_id): self
    {
        $this->conducteur_id = $conducteur_id;

        return $this;
    }

    public function getJawaz(): ?int
    {
        return $this->jawaz;
    }

    public function setJawaz(?int $jawaz): self
    {
        $this->jawaz = $jawaz;

        return $this;
    }

    public function getFraisGetion(): ?int
    {
        return $this->frais_getion;
    }

    public function setFraisGetion(?int $frais_getion): self
    {
        $this->frais_getion = $frais_getion;

        return $this;
    }

    public function getCarburant(): ?int
    {
        return $this->carburant;
    }

    public function setCarburant(?int $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getRemise(): ?int
    {
        return $this->remise;
    }

    public function setRemise(?int $remise): self
    {
        $this->remise = $remise;

        return $this;
    }
}
