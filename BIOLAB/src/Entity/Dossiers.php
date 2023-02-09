<?php

namespace App\Entity;

use App\Repository\DossiersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DossiersRepository::class)
 */
class Dossiers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDossier;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heure;

    /**
     * @ORM\Column(type="integer")
     */
    private $ipp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="date")
     */
    private $DateNais;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $sex;

    /**
     * @ORM\Column(type="string", length=20,nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $adress1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adress2;

    /**
     * @ORM\Column(type="string", length=30,nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $prescripteur;
 /**
     * @ORM\Column(type="string", length=255)
     */
    private $organismeNom;

 /**
     * @ORM\Column(type="string", length=255)
     */
    private $tarif_Org;
    /**
     * @ORM\ManyToOne(targetEntity=Organisme::class, inversedBy="dossiers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $organisme;

    /**
     * @ORM\ManyToOne(targetEntity=Tarif::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Tarif;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreB;

    /**
     * @ORM\Column(type="float")
     */
    private $prixB;

    /**
     * @ORM\Column(type="integer")
     */
    private $motif;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $obs;

    // /**
    //  * @ORM\OneToMany(targetEntity=DossierLG::class, mappedBy="dossiers")
    //  */
    // private $dossierLGs;

    /**
     * @ORM\Column(type="float")
     */
    private $montant_isd;

    /**
     * @ORM\Column(type="float")
     */
    private $mont_pre;

    /**
     * @ORM\Column(type="float")
     */
    private $mont_sup;

    /**
     * @ORM\Column(type="float")
     */
    private $mont_div;

    /**
     * @ORM\Column(type="float")
     */
    private $mont_lab;

    /**
     * @ORM\Column(type="float")
     */
    private $mont_ext;

    /**
     * @ORM\Column(type="float")
     */
    private $montant_hnso;
 /**
     * @ORM\Column(type="float")
     */
    private $mont_total;
    /**
     * @ORM\Column(type="float")
     */
    private $mont_idt;

    /**
     * @ORM\Column(type="float")
     */
    private $mont_cl;

    /**
     * @ORM\Column(type="float")
     */
    private $mont_org;

    /**
     * @ORM\Column(type="boolean")
     */
    private $annuler;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $user;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateSys;

    /**
     * @ORM\OneToMany(targetEntity=DossierLG::class, mappedBy="dossier")
     */
    private $dossierLGs;

    public function __construct()
    {
        // $this->dossierLGs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDossier(): ?\DateTimeInterface
    {
        return $this->dateDossier;
    }

    public function setDateDossier(\DateTimeInterface $dateDossier): self
    {
        $this->dateDossier = $dateDossier;

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

    public function getIpp(): ?int
    {
        return $this->ipp;
    }

    public function setIpp(int $ipp): self
    {
        $this->ipp = $ipp;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNais(): ?\DateTimeInterface
    {
        return $this->DateNais;
    }

    public function setDateNais(\DateTimeInterface $DateNais): self
    {
        $this->DateNais = $DateNais;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdress1(): ?string
    {
        return $this->adress1;
    }

    public function setAdress1(string $adress1): self
    {
        $this->adress1 = $adress1;

        return $this;
    }

    public function getAdress2(): ?string
    {
        return $this->adress2;
    }

    public function setAdress2(?string $adress2): self
    {
        $this->adress2 = $adress2;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPrescripteur(): ?string
    {
        return $this->prescripteur;
    }

    public function setPrescripteur(?string $prescripteur): self
    {
        $this->prescripteur = $prescripteur;

        return $this;
    }
    public function getOrganismeNom(): ?string
    {
        return $this->organismeNom;
    }

    public function setOrganismeNom(string $organismeNom): self
    {
        $this->organismeNom = $organismeNom;

        return $this;
    }

    public function getTarifOrg(): ?string
    {
        return $this->tarif_Org;
    }

    public function setTarifOrg(string $tarif_Org): self
    {
        $this->tarif_Org = $tarif_Org;

        return $this;
    }
    public function getOrganisme(): ?Organisme
    {
        return $this->organisme;
    }

    public function setOrganisme(?Organisme $organisme): self
    {
        $this->organisme = $organisme;

        return $this;
    }

    public function getTarif(): ?Tarif
    {
        return $this->Tarif;
    }

    public function setTarif(?Tarif $Tarif): self
    {
        $this->Tarif = $Tarif;

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

    public function getPrixB(): ?float
    {
        return $this->prixB;
    }

    public function setPrixB(float $prixB): self
    {
        $this->prixB = $prixB;

        return $this;
    }

    public function getMotif(): ?int
    {
        return $this->motif;
    }

    public function setMotif(int $motif): self
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

    // /**
    //  * @return Collection<int, DossierLG>
    //  */
    // public function getDossierLGs(): Collection
    // {
    //     return $this->dossierLGs;
    // }

    // public function addDossierLG(DossierLG $dossierLG): self
    // {
    //     if (!$this->dossierLGs->contains($dossierLG)) {
    //         $this->dossierLGs[] = $dossierLG;
    //         $dossierLG->setDossiers($this);
    //     }

    //     return $this;
    // }

    // public function removeDossierLG(DossierLG $dossierLG): self
    // {
    //     if ($this->dossierLGs->removeElement($dossierLG)) {
    //         // set the owning side to null (unless already changed)
    //         if ($dossierLG->getDossiers() === $this) {
    //             $dossierLG->setDossiers(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getMontantIsd(): ?float
    {
        return $this->montant_isd;
    }

    public function setMontantIsd(float $montant_isd): self
    {
        $this->montant_isd = $montant_isd;

        return $this;
    }

    public function getMontPre(): ?float
    {
        return $this->mont_pre;
    }

    public function setMontPre(float $mont_pre): self
    {
        $this->mont_pre = $mont_pre;

        return $this;
    }

    public function getMontSup(): ?float
    {
        return $this->mont_sup;
    }

    public function setMontSup(float $mont_sup): self
    {
        $this->mont_sup = $mont_sup;

        return $this;
    }

    public function getMontDiv(): ?float
    {
        return $this->mont_div;
    }

    public function setMontDiv(float $mont_div): self
    {
        $this->mont_div = $mont_div;

        return $this;
    }

    public function getMontLab(): ?float
    {
        return $this->mont_lab;
    }

    public function setMontLab(float $mont_lab): self
    {
        $this->mont_lab = $mont_lab;

        return $this;
    }

    public function getMontExt(): ?float
    {
        return $this->mont_ext;
    }

    public function setMontExt(float $mont_ext): self
    {
        $this->mont_ext = $mont_ext;

        return $this;
    }

    public function getMontantHnso(): ?float
    {
        return $this->montant_hnso;
    }

    public function setMontantHnso(float $montant_hnso): self
    {
        $this->montant_hnso = $montant_hnso;

        return $this;
    }
 public function getMontTotal(): ?float
                {
                    return $this->mont_total;
                }

    public function setMontTotal(float $mont_total): self
    {
        $this->mont_total = $mont_total;

        return $this;
    }
    public function getMontIdt(): ?float
    {
        return $this->mont_idt;
    }

    public function setMontIdt(float $mont_idt): self
    {
        $this->mont_idt = $mont_idt;

        return $this;
    }

    public function getMontCl(): ?float
    {
        return $this->mont_cl;
    }

    public function setMontCl(float $mont_cl): self
    {
        $this->mont_cl = $mont_cl;

        return $this;
    }

    public function getMontOrg(): ?float
    {
        return $this->mont_org;
    }

    public function setMontOrg(float $mont_org): self
    {
        $this->mont_org = $mont_org;

        return $this;
    }

    public function getAnnuler(): ?bool
    {
        return $this->annuler;
    }

    public function setAnnuler(bool $annuler): self
    {
        $this->annuler = $annuler;

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

    public function setDateSys(?\DateTimeInterface $dateSys): self
    {
        $this->dateSys = $dateSys;

        return $this;
    }

    /**
     * @return Collection<int, DossierLG>
     */
    public function getDossierLGs(): Collection
    {
        return $this->dossierLGs;
    }

    public function addDossierLG(DossierLG $dossierLG): self
    {
        if (!$this->dossierLGs->contains($dossierLG)) {
            $this->dossierLGs[] = $dossierLG;
            $dossierLG->setDossier($this);
        }

        return $this;
    }

    public function removeDossierLG(DossierLG $dossierLG): self
    {
        if ($this->dossierLGs->removeElement($dossierLG)) {
            // set the owning side to null (unless already changed)
            if ($dossierLG->getDossier() === $this) {
                $dossierLG->setDossier(null);
            }
        }

        return $this;
    }

   


}
