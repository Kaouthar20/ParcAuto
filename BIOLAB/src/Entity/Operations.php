<?php

namespace App\Entity;

use App\Repository\OperationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationsRepository::class)
 */
class Operations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // /**
    //  * @ORM\OneToMany(targetEntity=CA2020::class, mappedBy="operation")
    //  */
    // private $cA2020s;

    /**
     * @ORM\ManyToOne(targetEntity=Dossiers::class)
     */
    private $dossier;

    /**
     * @ORM\ManyToOne(targetEntity=Operations::class)
     */
    private $organisme;
    /**
     * @ORM\Column(type="string", length=100)
     */
    private $typ_ope;

    /**
     * @ORM\Column(type="date")
     */
    private $date_ope;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heure_ope;

    /**
     * @ORM\ManyToOne(targetEntity=OrganismeLG::class)
     */
    private $part;

    /**
     * @ORM\Column(type="float")
     */
    private $remise;

    /**
     * @ORM\Column(type="integer")
     */
    private $sens;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $BE;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_BE;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statutChqAvc;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     */
    private $dateSyst;

    public function __construct()
    {
        // $this->cA2020s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    // /**
    //  * @return Collection<int, CA2020>
    //  */
    // public function getCA2020s(): Collection
    // {
    //     return $this->cA2020s;
    // }

    // public function addCA2020(CA2020 $cA2020): self
    // {
    //     if (!$this->cA2020s->contains($cA2020)) {
    //         $this->cA2020s[] = $cA2020;
    //         $cA2020->setOperation($this);
    //     }

    //     return $this;
    // }

    // public function removeCA2020(CA2020 $cA2020): self
    // {
    //     if ($this->cA2020s->removeElement($cA2020)) {
    //         // set the owning side to null (unless already changed)
    //         if ($cA2020->getOperation() === $this) {
    //             $cA2020->setOperation(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getDossier(): ?Dossiers
    {
        return $this->dossier;
    }

    public function setDossier(?Dossiers $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }

    public function getTypOpe(): ?string
    {
        return $this->typ_ope;
    }

    public function setTypOpe(string $typ_ope): self
    {
        $this->typ_ope = $typ_ope;

        return $this;
    }

    public function getDateOpe(): ?\DateTimeInterface
    {
        return $this->date_ope;
    }

    public function setDateOpe(\DateTimeInterface $date_ope): self
    {
        $this->date_ope = $date_ope;

        return $this;
    }

    public function getHeureOpe(): ?\DateTimeInterface
    {
        return $this->heure_ope;
    }

    public function setHeureOpe(\DateTimeInterface $heure_ope): self
    {
        $this->heure_ope = $heure_ope;

        return $this;
    }

    public function getPart(): ?OrganismeLG
    {
        return $this->part;
    }

    public function setPart(?OrganismeLG $part): self
    {
        $this->part = $part;

        return $this;
    }

    public function getRemise(): ?float
    {
        return $this->remise;
    }

    public function setRemise(float $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getSens(): ?int
    {
        return $this->sens;
    }

    public function setSens(int $sens): self
    {
        $this->sens = $sens;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getBE(): ?int
    {
        return $this->BE;
    }

    public function setBE(?int $BE): self
    {
        $this->BE = $BE;

        return $this;
    }

    public function getDateBE(): ?\DateTimeInterface
    {
        return $this->date_BE;
    }

    public function setDateBE(?\DateTimeInterface $date_BE): self
    {
        $this->date_BE = $date_BE;

        return $this;
    }

    public function getStatutChqAvc(): ?bool
    {
        return $this->statutChqAvc;
    }

    public function setStatutChqAvc(bool $statutChqAvc): self
    {
        $this->statutChqAvc = $statutChqAvc;

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

    public function setDateSyst(\DateTimeInterface $dateSyst): self
    {
        $this->dateSyst = $dateSyst;

        return $this;
    }

    public function getOrganisme(): ?self
    {
        return $this->organisme;
    }

    public function setOrganisme(?self $organisme): self
    {
        $this->organisme = $organisme;

        return $this;
    }
}
