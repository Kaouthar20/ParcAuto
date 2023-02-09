<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_facture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code_facture;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $mt_total;

    /**
     * @ORM\ManyToOne(targetEntity=TypeFacture::class)
     */
    private $type_facture;



    /**
     * @ORM\OneToMany(targetEntity=FactureDet::class, mappedBy="facture")
     */
    private $factureDets;

    /**
     * @ORM\OneToOne(targetEntity=MissionCab::class, cascade={"persist", "remove"})
     */
    private $mission;

    public function __construct()
    {

        $this->factureDets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->date_facture;
    }

    public function setDateFacture(?\DateTimeInterface $date_facture): self
    {
        $this->date_facture = $date_facture;

        return $this;
    }

    public function getCodeFacture(): ?string
    {
        return $this->code_facture;
    }

    public function setCodeFacture(?string $code_facture): self
    {
        $this->code_facture = $code_facture;

        return $this;
    }

    public function getMtTotal(): ?float
    {
        return $this->mt_total;
    }

    public function setMtTotal(?float $mt_total): self
    {
        $this->mt_total = $mt_total;

        return $this;
    }

    public function getTypeFacture(): ?TypeFacture
    {
        return $this->type_facture;
    }

    public function setTypeFacture(?TypeFacture $type_facture): self
    {
        $this->type_facture = $type_facture;

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
            $factureDet->setFacture($this);
        }

        return $this;
    }

    public function removeFactureDet(FactureDet $factureDet): self
    {
        if ($this->factureDets->removeElement($factureDet)) {
            // set the owning side to null (unless already changed)
            if ($factureDet->getFacture() === $this) {
                $factureDet->setFacture(null);
            }
        }

        return $this;
    }

    public function getMission(): ?missionCab
    {
        return $this->mission;
    }

    public function setMission(?missionCab $mission): self
    {
        $this->mission = $mission;

        return $this;
    }
}
