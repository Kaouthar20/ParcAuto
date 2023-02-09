<?php

namespace App\Entity;

use App\Repository\MissionCabRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MissionCabRepository::class)
 */
class MissionCab
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $user_id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_mission;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville_mission;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adress_mission;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $km_depart;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $km_retour;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_depart;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_retour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $benificiare;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_personnes;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $inte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heure_depart;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $id_factured;

    /**
     * @ORM\ManyToOne(targetEntity=Site::class, inversedBy="missionCabs")
     */
    private $site_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code_mission;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $is_suspended;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_ibitier;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_valider;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_facturer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $user_add_mission;

    /**
     * @ORM\OneToOne(targetEntity=Facture::class, cascade={"persist", "remove"})
     */
    private $facture_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maj_weekend;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maj_nuit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $remise;

    /**
     * @ORM\Column(type="integer")
     */
    private $IdDossier;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_initier;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_valider;

    /**
     * @ORM\ManyToOne(targetEntity=StatusMission::class, inversedBy="missionCabs")
     */
    private $Statut;



    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getDateMission(): ?\DateTimeInterface
    {
        return $this->date_mission;
    }

    public function setDateMission(?\DateTimeInterface $date_mission): self
    {
        $this->date_mission = $date_mission;

        return $this;
    }

    public function getVilleMission(): ?string
    {
        return $this->ville_mission;
    }

    public function setVilleMission(?string $ville_mission): self
    {
        $this->ville_mission = $ville_mission;

        return $this;
    }

    public function getAdressMission(): ?string
    {
        return $this->adress_mission;
    }

    public function setAdressMission(?string $adress_mission): self
    {
        $this->adress_mission = $adress_mission;

        return $this;
    }

    public function getKmDepart(): ?float
    {
        return $this->km_depart;
    }

    public function setKmDepart(?float $km_depart): self
    {
        $this->km_depart = $km_depart;

        return $this;
    }

    public function getKmRetour(): ?float
    {
        return $this->km_retour;
    }

    public function setKmRetour(?float $km_retour): self
    {
        $this->km_retour = $km_retour;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeInterface
    {
        return $this->date_depart;
    }

    public function setDateDepart(?\DateTimeInterface $date_depart): self
    {
        $this->date_depart = $date_depart;

        return $this;
    }

    public function getDateRetour(): ?\DateTimeInterface
    {
        return $this->date_retour;
    }

    public function setDateRetour(?\DateTimeInterface $date_retour): self
    {
        $this->date_retour = $date_retour;

        return $this;
    }

    public function getBenificiare(): ?string
    {
        return $this->benificiare;
    }

    public function setBenificiare(?string $benificiare): self
    {
        $this->benificiare = $benificiare;

        return $this;
    }

    public function getNbPersonnes(): ?int
    {
        return $this->nb_personnes;
    }

    public function setNbPersonnes(?int $nb_personnes): self
    {
        $this->nb_personnes = $nb_personnes;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getInte(): ?string
    {
        return $this->inte;
    }

    public function setInte(?string $inte): self
    {
        $this->inte = $inte;

        return $this;
    }

    public function getHeureDepart(): ?string
    {
        return $this->heure_depart;
    }

    public function setHeureDepart(?string $heure_depart): self
    {
        $this->heure_depart = $heure_depart;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(?string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getIdFactured(): ?int
    {
        return $this->id_factured;
    }

    public function setIdFactured(?int $id_factured): self
    {
        $this->id_factured = $id_factured;

        return $this;
    }

    public function getSiteId(): ?Site
    {
        return $this->site_id;
    }

    public function setSiteId(?Site $site_id): self
    {
        $this->site_id = $site_id;

        return $this;
    }

    public function getCodeMission(): ?string
    {
        return $this->code_mission;
    }

    public function setCodeMission(?string $code_mission): self
    {
        $this->code_mission = $code_mission;

        return $this;
    }

    public function getIsSuspended(): ?int
    {
        return $this->is_suspended;
    }

    public function setIsSuspended(?int $is_suspended): self
    {
        $this->is_suspended = $is_suspended;

        return $this;
    }

    public function getUserIbitier(): ?string
    {
        return $this->user_ibitier;
    }

    public function setUserIbitier(?string $user_ibitier): self
    {
        $this->user_ibitier = $user_ibitier;

        return $this;
    }

    public function getUserValider(): ?string
    {
        return $this->user_valider;
    }

    public function setUserValider(?string $user_valider): self
    {
        $this->user_valider = $user_valider;

        return $this;
    }

    public function getUserFacturer(): ?string
    {
        return $this->user_facturer;
    }

    public function setUserFacturer(?string $user_facturer): self
    {
        $this->user_facturer = $user_facturer;

        return $this;
    }

    public function getUserAddMission(): ?string
    {
        return $this->user_add_mission;
    }

    public function setUserAddMission(?string $user_add_mission): self
    {
        $this->user_add_mission = $user_add_mission;

        return $this;
    }

    public function getFactureId(): ?Facture
    {
        return $this->facture_id;
    }

    public function setFactureId(?Facture $facture_id): self
    {
        $this->facture_id = $facture_id;

        return $this;
    }

    public function getMajWeekend(): ?int
    {
        return $this->maj_weekend;
    }

    public function setMajWeekend(?int $maj_weekend): self
    {
        $this->maj_weekend = $maj_weekend;

        return $this;
    }

    public function getMajNuit(): ?int
    {
        return $this->maj_nuit;
    }

    public function setMajNuit(?int $maj_nuit): self
    {
        $this->maj_nuit = $maj_nuit;

        return $this;
    }

    public function getRemise(): ?int
    {
        return $this->remise;
    }

    public function setRemise(?int $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getIdDossier(): ?int
    {
        return $this->IdDossier;
    }

    public function setIdDossier(int $IdDossier): self
    {
        $this->IdDossier = $IdDossier;

        return $this;
    }

    public function isIsInitier(): ?bool
    {
        return $this->is_initier;
    }

    public function setIsInitier(?bool $is_initier): self
    {
        $this->is_initier = $is_initier;

        return $this;
    }

    public function isIsValider(): ?bool
    {
        return $this->is_valider;
    }

    public function setIsValider(?bool $is_valider): self
    {
        $this->is_valider = $is_valider;

        return $this;
    }

    public function getStatut(): ?StatusMission
    {
        return $this->Statut;
    }

    public function setStatut(?StatusMission $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }
}
