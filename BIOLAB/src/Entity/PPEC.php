<?php

namespace App\Entity;

use App\Repository\PPECRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PPECRepository::class)
 */
class PPEC
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
     * @ORM\Column(type="string", length=50)
     */
    private $numPEC;

    /**
     * @ORM\Column(type="date")
     */
    private $datePEC;
 /**
     * @ORM\Column(type="string", length=50)
     */
    private $matricule;
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adherent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $beneficiaire;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="date")
     */
    private $dateSys;

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

    public function getNumPEC(): ?string
    {
        return $this->numPEC;
    }

    public function setNumPEC(string $numPEC): self
    {
        $this->numPEC = $numPEC;

        return $this;
    }

    public function getDatePEC(): ?\DateTimeInterface
    {
        return $this->datePEC;
    }

    public function setDatePEC(\DateTimeInterface $datePEC): self
    {
        $this->datePEC = $datePEC;

        return $this;
    }
 public function getMatricule(): ?string
             {
                 return $this->matricule;
             }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }
    public function getAdherent(): ?string
    {
        return $this->adherent;
    }

    public function setAdherent(string $adherent): self
    {
        $this->adherent = $adherent;

        return $this;
    }

   public function getBeneficiaire(): ?string
    {
        return $this->beneficiaire;
    }

    public function setBeneficiaire(string $beneficiaire): self
    {
        $this->beneficiaire = $beneficiaire;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

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

    public function getDateSys(): ?\DateTimeInterface
    {
        return $this->dateSys;
    }

    public function setDateSys(\DateTimeInterface $dateSys): self
    {
        $this->dateSys = $dateSys;

        return $this;
    }

   

    
}
