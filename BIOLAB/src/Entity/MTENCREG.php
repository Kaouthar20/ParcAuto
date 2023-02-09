<?php

namespace App\Entity;

use App\Repository\MTENCREGRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MTENCREGRepository::class)
 */
class MTENCREG
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Operations::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $operation;

    /**
     * @ORM\Column(type="float")
     */
    private $somMontant;

    /**
     * @ORM\ManyToOne(targetEntity=Paiement::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $paiement;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSomMontant(): ?float
    {
        return $this->somMontant;
    }

    public function setSomMontant(float $somMontant): self
    {
        $this->somMontant = $somMontant;

        return $this;
    }

    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(?Paiement $paiement): self
    {
        $this->paiement = $paiement;

        return $this;
    }
}
