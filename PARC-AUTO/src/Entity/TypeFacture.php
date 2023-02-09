<?php

namespace App\Entity;

use App\Repository\TypeFactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeFactureRepository::class)
 */
class TypeFacture
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
    private $designation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ref_type_facture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(?string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getRefTypeFacture(): ?string
    {
        return $this->ref_type_facture;
    }

    public function setRefTypeFacture(?string $ref_type_facture): self
    {
        $this->ref_type_facture = $ref_type_facture;

        return $this;
    }
}
