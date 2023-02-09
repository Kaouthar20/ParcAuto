<?php

namespace App\Entity;

use App\Repository\DossierLGRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DossierLGRepository::class)
 */
class DossierLG
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // /**
    //  * @ORM\ManyToOne(targetEntity=Dossiers::class, inversedBy="dossierLGs")
    //  * @ORM\JoinColumn(nullable=false)
    //  */
    // private $dossiers;

    /**
     * @ORM\ManyToOne(targetEntity=CorrespAnalyse::class, inversedBy="dossierLGs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $codeAnalyse;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $statut_HN;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $lettre;

    /**
     * @ORM\Column(type="float")
     */
    private $nbreB;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeTarif;

    /**
     * @ORM\Column(type="float")
     */
    private $tarifPrix;

    /**
     * @ORM\Column(type="float")
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $extern;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $lieu_ext;

    /**
     * @ORM\Column(type="integer")
     */
    private $codeNomenc;

    /**
     * @ORM\Column(type="integer")
     */
    private $tauxTP;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pec;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $maj;

    /**
     * @ORM\Column(type="boolean")
     */
    private $remboursemment;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateSyst;

    /**
     * @ORM\ManyToOne(targetEntity=Dossiers::class, inversedBy="dossierLGs")
     */
    private $dossier;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getDossiers(): ?Dossiers
    // {
    //     return $this->dossiers;
    // }

    // public function setDossiers(?Dossiers $dossiers): self
    // {
    //     $this->dossiers = $dossiers;

    //     return $this;
    // }

    public function getCodeAnalyse(): ?CorrespAnalyse
    {
        return $this->codeAnalyse;
    }

    public function setCodeAnalyse(?CorrespAnalyse $codeAnalyse): self
    {
        $this->codeAnalyse = $codeAnalyse;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getStatutHN(): ?string
    {
        return $this->statut_HN;
    }

    public function setStatutHN(string $statut_HN): self
    {
        $this->statut_HN = $statut_HN;

        return $this;
    }

    public function getLettre(): ?string
    {
        return $this->lettre;
    }

    public function setLettre(string $lettre): self
    {
        $this->lettre = $lettre;

        return $this;
    }

    public function getNbreB(): ?int
    {
        return $this->nbreB;
    }

    public function setNbreB(int $nbreB): self
    {
        $this->nbreB = $nbreB;

        return $this;
    }

    public function getNbre(): ?int
    {
        return $this->nbre;
    }

    public function setNbre(int $nbre): self
    {
        $this->nbre = $nbre;

        return $this;
    }

    public function getCodeTarif(): ?int
    {
        return $this->codeTarif;
    }

    public function setCodeTarif(int $codeTarif): self
    {
        $this->codeTarif = $codeTarif;

        return $this;
    }

    public function getTarifPrix(): ?float
    {
        return $this->tarifPrix;
    }

    public function setTarifPrix(float $tarifPrix): self
    {
        $this->tarifPrix = $tarifPrix;

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

    public function getExtern(): ?string
    {
        return $this->extern;
    }

    public function setExtern(string $extern): self
    {
        $this->extern = $extern;

        return $this;
    }

    public function getLieuExt(): ?string
    {
        return $this->lieu_ext;
    }

    public function setLieuExt(string $lieu_ext): self
    {
        $this->lieu_ext = $lieu_ext;

        return $this;
    }

    public function getCodeNomenc(): ?int
    {
        return $this->codeNomenc;
    }

    public function setCodeNomenc(int $codeNomenc): self
    {
        $this->codeNomenc = $codeNomenc;

        return $this;
    }

    public function getTauxTP(): ?int
    {
        return $this->tauxTP;
    }

    public function setTauxTP(int $tauxTP): self
    {
        $this->tauxTP = $tauxTP;

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

    public function getMaj(): ?bool
    {
        return $this->maj;
    }

    public function setMaj(?bool $maj): self
    {
        $this->maj = $maj;

        return $this;
    }

    public function getRemboursemment(): ?bool
    {
        return $this->remboursemment;
    }

    public function setRemboursemment(bool $remboursemment): self
    {
        $this->remboursemment = $remboursemment;

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

    public function getDossier(): ?Dossiers
    {
        return $this->dossier;
    }

    public function setDossier(?Dossiers $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }
}
