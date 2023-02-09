<?php

namespace App\Entity;

use App\Repository\OrganismeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrganismeRepository::class)
 */
class Organisme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lebelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tiers;

  

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $remise;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pec;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rectif;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $xFacture;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $user;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateSyst;

    /**
     * @ORM\OneToMany(targetEntity=Dossiers::class, mappedBy="organisme")
     */
    private $dossiers;

    /**
     * @ORM\OneToMany(targetEntity=CorrespAnalyse::class, mappedBy="Organisme")
     */
    private $correspAnalyses;

    public function __construct()
    {
        $this->dossiers = new ArrayCollection();
        $this->correspAnalyses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getLebelle(): ?string
    {
        return $this->lebelle;
    }

    public function setLebelle(string $lebelle): self
    {
        $this->lebelle = $lebelle;

        return $this;
    }

    public function getTiers(): ?string
    {
        return $this->tiers;
    }

    public function setTiers(string $tiers): self
    {
        $this->tiers = $tiers;

        return $this;
    }

    

    public function getRemise(): ?float
    {
        return $this->remise;
    }

    public function setRemise(?float $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getPec(): ?bool
    {
        return $this->pec;
    }

    public function setPec(?bool $pec): self
    {
        $this->pec = $pec;

        return $this;
    }

    public function getRectif(): ?bool
    {
        return $this->rectif;
    }

    public function setRectif(?bool $rectif): self
    {
        $this->rectif = $rectif;

        return $this;
    }

    public function getXFacture(): ?bool
    {
        return $this->xFacture;
    }

    public function setXFacture(?bool $xFacture): self
    {
        $this->xFacture = $xFacture;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDateSyst(): ?\DateTimeInterface
    {
        return $this->dateSyst;
    }

    public function setDateSyst(?\DateTimeInterface $dateSyst): self
    {
        $this->dateSyst = $dateSyst;

        return $this;
    }

    /**
     * @return Collection<int, Dossiers>
     */
    public function getDossiers(): Collection
    {
        return $this->dossiers;
    }

    public function addDossier(Dossiers $dossier): self
    {
        if (!$this->dossiers->contains($dossier)) {
            $this->dossiers[] = $dossier;
            $dossier->setOrganisme($this);
        }

        return $this;
    }

    public function removeDossier(Dossiers $dossier): self
    {
        if ($this->dossiers->removeElement($dossier)) {
            // set the owning side to null (unless already changed)
            if ($dossier->getOrganisme() === $this) {
                $dossier->setOrganisme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CorrespAnalyse>
     */
    public function getCorrespAnalyses(): Collection
    {
        return $this->correspAnalyses;
    }

    public function addCorrespAnalysis(CorrespAnalyse $correspAnalysis): self
    {
        if (!$this->correspAnalyses->contains($correspAnalysis)) {
            $this->correspAnalyses[] = $correspAnalysis;
            $correspAnalysis->setOrganisme($this);
        }

        return $this;
    }

    public function removeCorrespAnalysis(CorrespAnalyse $correspAnalysis): self
    {
        if ($this->correspAnalyses->removeElement($correspAnalysis)) {
            // set the owning side to null (unless already changed)
            if ($correspAnalysis->getOrganisme() === $this) {
                $correspAnalysis->setOrganisme(null);
            }
        }

        return $this;
    }
}
