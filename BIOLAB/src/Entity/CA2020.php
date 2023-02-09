<?php

namespace App\Entity;

use App\Repository\CA2020Repository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CA2020Repository::class)
 */
class CA2020
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Dossiers::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $dossier;

    /**
     * @ORM\ManyToOne(targetEntity=Operations::class, inversedBy="cA2020s")
     * @ORM\JoinColumn(nullable=false)
     */
    private $operation;

    /**
     * @ORM\ManyToOne(targetEntity=Organisme::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisme;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $libelle;

    /**
     * @ORM\Column(type="float")
     */
    private $ca_MORR;
/**
     * @ORM\Column(type="integer")
     */
    private $dossiers_motif;
     /**
     * @ORM\Column(type="string", length=100)
     */
    private $motif_Imp;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDossier(): ?Dossiers
    {
        return $this->dossier;
    }

    public function setDossier(?Dossiers $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }

    public function getOperation(): ?Operations
    {
        return $this->operation;
    }

    public function setOperation(?Operations $operation): self
    {
        $this->operation = $operation;

        return $this;
    }

    public function getOrganisme(): ?Organisme
    {
        return $this->organisme;
    }

    public function setOrganisme(?Organisme $organisme): self
    {
        $this->organisme = $organisme;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCaMORR(): ?float
    {
        return $this->ca_MORR;
    }

    public function setCaMORR(float $ca_MORR): self
    {
        $this->ca_MORR = $ca_MORR;

        return $this;
    }

   

  
}
