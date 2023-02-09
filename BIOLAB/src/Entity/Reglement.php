<?php

namespace App\Entity;

use App\Repository\ReglementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReglementRepository::class)
 */
class Reglement
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
    private $opration;

    /**
     * @ORM\Column(type="date")
     */
    private $dateOper;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heure;

    /**
     * @ORM\Column(type="date")
     */
    private $dateRegl;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heurRegl;

    /**
     * @ORM\ManyToOne(targetEntity=Devise::class)
     */
    private $devise;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sens;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity=Paiement::class)
     */
    private $paiement;

    /**
     * @ORM\Column(type="date")
     */
    private $date_cheq;

    /**
     * @ORM\Column(type="date")
     */
    private $date_ech;

    /**
     * @ORM\ManyToOne(targetEntity=Banque::class)
     */
    private $banque;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $place;
      /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $reference_regl;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $titulaire;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $type_regl;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $impayer;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $statut_cheqAvec;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $statut_user;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $BE_banq;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_Be_Banq;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $be_repart_banq;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $littrage;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateLittrage;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_remise;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_valeur;
      /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reference_relv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpration(): ?Operations
    {
        return $this->opration;
    }

    public function setOpration(?Operations $opration): self
    {
        $this->opration = $opration;

        return $this;
    }

    public function getDateOper(): ?\DateTimeInterface
    {
        return $this->dateOper;
    }

    public function setDateOper(\DateTimeInterface $dateOper): self
    {
        $this->dateOper = $dateOper;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getDateRegl(): ?\DateTimeInterface
    {
        return $this->dateRegl;
    }

    public function setDateRegl(\DateTimeInterface $dateRegl): self
    {
        $this->dateRegl = $dateRegl;

        return $this;
    }

    public function getHeurRegl(): ?\DateTimeInterface
    {
        return $this->heurRegl;
    }

    public function setHeurRegl(\DateTimeInterface $heurRegl): self
    {
        $this->heurRegl = $heurRegl;

        return $this;
    }

    public function getDevise(): ?Devise
    {
        return $this->devise;
    }

    public function setDevise(?Devise $devise): self
    {
        $this->devise = $devise;

        return $this;
    }

    public function getSens(): ?int
    {
        return $this->sens;
    }

    public function setSens(?int $sens): self
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

    public function getPaiement(): ?Paiement
    {
        return $this->paiement;
    }

    public function setPaiement(?Paiement $paiement): self
    {
        $this->paiement = $paiement;

        return $this;
    }

    public function getDateCheq(): ?\DateTimeInterface
    {
        return $this->date_cheq;
    }

    public function setDateCheq(\DateTimeInterface $date_cheq): self
    {
        $this->date_cheq = $date_cheq;

        return $this;
    }

    public function getDateEch(): ?\DateTimeInterface
    {
        return $this->date_ech;
    }

    public function setDateEch(\DateTimeInterface $date_ech): self
    {
        $this->date_ech = $date_ech;

        return $this;
    }

    public function getBanque(): ?Banque
    {
        return $this->banque;
    }

    public function setBanque(?Banque $banque): self
    {
        $this->banque = $banque;

        return $this;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getReferenceRegl(): ?string
    {
        return $this->reference_regl;
    }

    public function setReferenceRegl(string $reference_regl): self
    {
        $this->reference_regl = $reference_regl;

        return $this;
    }

    public function getTitulaire(): ?string
    {
        return $this->titulaire;
    }

    public function setTitulaire(?string $titulaire): self
    {
        $this->titulaire = $titulaire;

        return $this;
    }

    public function getTypeRegl(): ?string
    {
        return $this->type_regl;
    }

    public function setTypeRegl(?string $type_regl): self
    {
        $this->type_regl = $type_regl;

        return $this;
    }

    public function getImpayer(): ?bool
    {
        return $this->impayer;
    }

    public function setImpayer(?bool $impayer): self
    {
        $this->impayer = $impayer;

        return $this;
    }

    public function getStatutCheqAvec(): ?string
    {
        return $this->statut_cheqAvec;
    }

    public function setStatutCheqAvec(string $statut_cheqAvec): self
    {
        $this->statut_cheqAvec = $statut_cheqAvec;

        return $this;
    }

    public function getStatutUser(): ?User
    {
        return $this->statut_user;
    }

    public function setStatutUser(?User $statut_user): self
    {
        $this->statut_user = $statut_user;

        return $this;
    }

    public function getBEBanq(): ?string
    {
        return $this->BE_banq;
    }

    public function setBEBanq(string $BE_banq): self
    {
        $this->BE_banq = $BE_banq;

        return $this;
    }

    public function getDateBeBanq(): ?\DateTimeInterface
    {
        return $this->date_Be_Banq;
    }

    public function setDateBeBanq(?\DateTimeInterface $date_Be_Banq): self
    {
        $this->date_Be_Banq = $date_Be_Banq;

        return $this;
    }

    public function getBeRepartBanq(): ?string
    {
        return $this->be_repart_banq;
    }

    public function setBeRepartBanq(?string $be_repart_banq): self
    {
        $this->be_repart_banq = $be_repart_banq;

        return $this;
    }

    public function getLittrage(): ?string
    {
        return $this->littrage;
    }

    public function setLittrage(?string $littrage): self
    {
        $this->littrage = $littrage;

        return $this;
    }

    public function getDateLittrage(): ?\DateTimeInterface
    {
        return $this->dateLittrage;
    }

    public function setDateLittrage(?\DateTimeInterface $dateLittrage): self
    {
        $this->dateLittrage = $dateLittrage;

        return $this;
    }

    public function getDateRemise(): ?\DateTimeInterface
    {
        return $this->date_remise;
    }

    public function setDateRemise(?\DateTimeInterface $date_remise): self
    {
        $this->date_remise = $date_remise;

        return $this;
    }

    public function getDateValeur(): ?\DateTimeInterface
    {
        return $this->date_valeur;
    }

    public function setDateValeur(?\DateTimeInterface $date_valeur): self
    {
        $this->date_valeur = $date_valeur;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getReferenceRelv(): ?string
    {
        return $this->reference_relv;
    }

    public function setReferenceRelv(?string $reference_relv): self
    {
        $this->reference_relv = $reference_relv;

        return $this;
    }
}
