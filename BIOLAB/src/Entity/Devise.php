<?php

namespace App\Entity;

use App\Repository\DeviseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeviseRepository::class)
 */
class Devise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $deviseName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeviseName(): ?string
    {
        return $this->deviseName;
    }

    public function setDeviseName(string $deviseName): self
    {
        $this->deviseName = $deviseName;

        return $this;
    }
}
