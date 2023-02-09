<?php

namespace App\Entity;

use App\Repository\OrganismeLGRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrganismeLGRepository::class)
 */
class OrganismeLG
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Organisme::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisme;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tarif;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $partAdherent;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $partOrganisme;

    public function getId(): ?int
    {
        return $this->id;
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

    

    public function getPartAdherent(): ?float
    {
        return $this->partAdherent;
    }

    public function setPartAdherent(?float $partAdherent): self
    {
        $this->partAdherent = $partAdherent;

        return $this;
    }

    public function getPartOrganisme(): ?float
    {
        return $this->partOrganisme;
    }

    public function setPartOrganisme(?float $partOrganisme): self
    {
        $this->partOrganisme = $partOrganisme;

        return $this;
    }

    public function getTarif(): ?float
    {
        return $this->tarif;
    }

    public function setTarif(?float $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }

    
}
