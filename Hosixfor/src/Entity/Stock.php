<?php

namespace App\Entity;

use App\Repository\StockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: StockRepository::class)]
class Stock
{  
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $nom;

    #[ORM\Column(type: 'integer')]
    private $code;

    #[ORM\OneToMany(mappedBy: 'stock', targetEntity: Article::class)]
    private $article;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fabrique;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $achete;

    #[ORM\Column(type: 'float', nullable: true)]
    private $prixAchat;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantite;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateExp;

    public function __construct()
    {
        $this->article = new ArrayCollection();
    }

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

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticle(): Collection
    {
        return $this->article;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->article->contains($article)) {
            $this->article[] = $article;
            $article->setStock($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->article->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getStock() === $this) {
                $article->setStock(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getFabrique(): ?\DateTimeInterface
    {
        return $this->fabrique;
    }

    public function setFabrique(?\DateTimeInterface $fabrique): self
    {
        $this->fabrique = $fabrique;

        return $this;
    }

    public function getAchete(): ?\DateTimeInterface
    {
        return $this->achete;
    }

    public function setAchete(?\DateTimeInterface $achete): self
    {
        $this->achete = $achete;

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(?float $prixAchat): self
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateExp(): ?\DateTimeInterface
    {
        return $this->dateExp;
    }

    public function setDateExp(?\DateTimeInterface $dateExp): self
    {
        $this->dateExp = $dateExp;

        return $this;
    }
}
