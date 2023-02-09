<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $site_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dependence;

    /**
     * @ORM\OneToMany(targetEntity=MissionCab::class, mappedBy="site_id")
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

    public function getSiteName(): ?string
    {
        return $this->site_name;
    }

    public function setSiteName(?string $site_name): self
    {
        $this->site_name = $site_name;

        return $this;
    }

    public function getDependence(): ?string
    {
        return $this->dependence;
    }

    public function setDependence(?string $dependence): self
    {
        $this->dependence = $dependence;

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
            $missionCab->setSiteId($this);
        }

        return $this;
    }

    public function removeMissionCab(MissionCab $missionCab): self
    {
        if ($this->missionCabs->removeElement($missionCab)) {
            // set the owning side to null (unless already changed)
            if ($missionCab->getSiteId() === $this) {
                $missionCab->setSiteId(null);
            }
        }

        return $this;
    }
}
