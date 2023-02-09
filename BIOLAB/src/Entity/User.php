<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $surNom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $motPass;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordre;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $demarrage;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_syst;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSurNom(): ?string
    {
        return $this->surNom;
    }

    public function setSurNom(?string $surNom): self
    {
        $this->surNom = $surNom;

        return $this;
    }

    public function getMotPass(): ?string
    {
        return $this->motPass;
    }

    public function setMotPass(string $motPass): self
    {
        $this->motPass = $motPass;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    public function getDemarrage(): ?string
    {
        return $this->demarrage;
    }

    public function setDemarrage(string $demarrage): self
    {
        $this->demarrage = $demarrage;

        return $this;
    }

    public function getDateSyst(): ?\DateTimeInterface
    {
        return $this->date_syst;
    }

    public function setDateSyst(?\DateTimeInterface $date_syst): self
    {
        $this->date_syst = $date_syst;

        return $this;
    }
}
