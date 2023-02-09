<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $numc;

    #[ORM\Column(type: 'datetime')]
    private $dateCommande;

    #[ORM\Column(type: 'text', nullable: true)]
    private $observation;

    #[ORM\Column(type: 'float')]
    private $totht;

    #[ORM\Column(type: 'float')]
    private $tottva;

    #[ORM\Column(type: 'float')]
    private $totttc;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: LigneCommande::class)]
    private $ligneCommandes;

    public function __construct()
    {
        $this->ligneCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumc(): ?string
    {
        return $this->numc;
    }

    public function setNumc(string $numc): self
    {
        $this->numc = $numc;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

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

    public function getTotht(): ?float
    {
        return $this->totht;
    }

    public function setTotht(float $totht): self
    {
        $this->totht = $totht;

        return $this;
    }

    public function getTottva(): ?float
    {
        return $this->tottva;
    }

    public function setTottva(float $tottva): self
    {
        $this->tottva = $tottva;

        return $this;
    }

    public function getTotttc(): ?float
    {
        return $this->totttc;
    }

    public function setTotttc(float $totttc): self
    {
        $this->totttc = $totttc;

        return $this;
    }

    /**
     * @return Collection<int, LigneCommande>
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getCommande() === $this) {
                $ligneCommande->setCommande(null);
            }
        }

        return $this;
    }
}
