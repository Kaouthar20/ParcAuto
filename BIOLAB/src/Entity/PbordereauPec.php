<?php

namespace App\Entity;

use App\Repository\PbordereauPecRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PbordereauPecRepository::class)
 */
class PbordereauPec
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
     * @ORM\ManyToOne(targetEntity=Operations::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $operation;

    /**
     * @ORM\ManyToOne(targetEntity=PStatutPec::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $statut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $BE;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_BE;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $motif;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $obs;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="date", nullable=true)
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

    public function getOperation(): ?Operations
    {
        return $this->operation;
    }

    public function setOperation(?Operations $operation): self
    {
        $this->operation = $operation;

        return $this;
    }

    public function getStatut(): ?PStatutPec
    {
        return $this->statut;
    }

    public function setStatut(?PStatutPec $statut): self
    {
        $this->statut = $statut;

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

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(?string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getObs(): ?string
    {
        return $this->obs;
    }

    public function setObs(?string $obs): self
    {
        $this->obs = $obs;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDateSys(): ?\DateTimeInterface
    {
        return $this->dateSys;
    }

    public function setDateSys(?\DateTimeInterface $dateSys): self
    {
        $this->dateSys = $dateSys;

        return $this;
    }
}
