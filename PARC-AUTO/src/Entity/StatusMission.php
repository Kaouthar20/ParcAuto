<?php

namespace App\Entity;

use App\Repository\StatusMissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusMissionRepository::class)
 */
class StatusMission
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
    private $Statut;

    /**
     * @ORM\OneToMany(targetEntity=MissionCab::class, mappedBy="Statut")
     */
    private $missionCabs;

    public function __construct()
    {
        $this->missionCabs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?string
    {
        return $this->Statut;
    }

    public function setStatut(string $Statut): self
    {
        $this->Statut = $Statut;

        return $this;
    }

    /**
     * @return Collection<int, MissionCab>
     */
    public function getMissionCabs(): Collection
    {
        return $this->missionCabs;
    }

    public function addMissionCab(MissionCab $missionCab): self
    {
        if (!$this->missionCabs->contains($missionCab)) {
            $this->missionCabs[] = $missionCab;
            $missionCab->setStatut($this);
        }

        return $this;
    }

    public function removeMissionCab(MissionCab $missionCab): self
    {
        if ($this->missionCabs->removeElement($missionCab)) {
            // set the owning side to null (unless already changed)
            if ($missionCab->getStatut() === $this) {
                $missionCab->setStatut(null);
            }
        }

        return $this;
    }
}
