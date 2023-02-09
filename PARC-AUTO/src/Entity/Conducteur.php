<?php

namespace App\Entity;

use App\Repository\ConducteurRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConducteurRepository::class)
 */
class Conducteur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $matricule_canducteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom_canducteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom_conducteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $situation_conducteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculeCanducteur(): ?string
    {
        return $this->matricule_canducteur;
    }

    public function setMatriculeCanducteur(?string $matricule_canducteur): self
    {
        $this->matricule_canducteur = $matricule_canducteur;

        return $this;
    }

    public function getNomCanducteur(): ?string
    {
        return $this->nom_canducteur;
    }

    public function setNomCanducteur(?string $nom_canducteur): self
    {
        $this->nom_canducteur = $nom_canducteur;

        return $this;
    }

    public function getPrenomConducteur(): ?string
    {
        return $this->prenom_conducteur;
    }

    public function setPrenomConducteur(?string $prenom_conducteur): self
    {
        $this->prenom_conducteur = $prenom_conducteur;

        return $this;
    }

    public function getSituationConducteur(): ?string
    {
        return $this->situation_conducteur;
    }

    public function setSituationConducteur(?string $situation_conducteur): self
    {
        $this->situation_conducteur = $situation_conducteur;

        return $this;
    }
}
