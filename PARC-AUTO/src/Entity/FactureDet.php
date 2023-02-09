<?php

namespace App\Entity;

use App\Repository\FactureDetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureDetRepository::class)
 */
class FactureDet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=facture::class, inversedBy="factureDets")
     */
    private $facture;

    /**
     * @ORM\ManyToOne(targetEntity=Prestation::class, inversedBy="factureDets")
     */
    private $prestation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFacture(): ?facture
    {
        return $this->facture;
    }

    public function setFacture(?facture $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    public function getPrestation(): ?prestation
    {
        return $this->prestation;
    }

    public function setPrestation(?prestation $prestation): self
    {
        $this->prestation = $prestation;

        return $this;
    }
}
