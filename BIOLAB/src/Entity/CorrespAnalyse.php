<?php

namespace App\Entity;

use App\Repository\CorrespAnalyseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CorrespAnalyseRepository::class)
 */
class CorrespAnalyse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Organisme::class, inversedBy="correspAnalyses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Organisme;

    /**
     * @ORM\Column(type="integer")
     */
    private $groupe;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrB;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $libelle;
  /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $code_analyse;
    /**
     * @ORM\OneToMany(targetEntity=DossierLG::class, mappedBy="codeAnalyse")
     */
    private $dossierLGs;

    public function __construct()
    {
        $this->dossierLGs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrganisme(): ?Organisme
    {
        return $this->Organisme;
    }

    public function setOrganisme(?Organisme $Organisme): self
    {
        $this->Organisme = $Organisme;

        return $this;
    }

    public function getGroupe(): ?int
    {
        return $this->groupe;
    }

    public function setGroupe(int $groupe): self
    {
        $this->groupe = $groupe;

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

    public function getNbrB(): ?int
    {
        return $this->nbrB;
    }

    public function setNbrB(int $nbrB): self
    {
        $this->nbrB = $nbrB;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

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
            $dossierLG->setCodeAnalyse($this);
        }

        return $this;
    }

    public function removeDossierLG(DossierLG $dossierLG): self
    {
        if ($this->dossierLGs->removeElement($dossierLG)) {
            // set the owning side to null (unless already changed)
            if ($dossierLG->getCodeAnalyse() === $this) {
                $dossierLG->setCodeAnalyse(null);
            }
        }

        return $this;
    }
}
