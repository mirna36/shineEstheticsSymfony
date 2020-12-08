<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use App\Service\AppService;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShopRepository", repositoryClass=ShopRepository::class)
 * @ORM\HasLifecycleCallbacks
 */
class Shop
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
    private $libelle;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private  $createdAt;


    /**
     * @ORM\OneToMany(targetEntity=ArticlesPrestations::class, mappedBy="shop")
     */
    private $articlesPrestations;

    public function __construct()
    {
        $this->articlesPrestations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|ArticlesPrestations[]
     */
    public function getArticlesPrestations(): Collection
    {
        return $this->articlesPrestations;
    }

    public function addArticlesPrestation(ArticlesPrestations $articlesPrestation): self
    {
        if (!$this->articlesPrestations->contains($articlesPrestation)) {
            $this->articlesPrestations[] = $articlesPrestation;
            $articlesPrestation->setShop($this);
        }

        return $this;
    }

    public function removeArticlesPrestation(ArticlesPrestations $articlesPrestation): self
    {
        if ($this->articlesPrestations->removeElement($articlesPrestation)) {
            // set the owning side to null (unless already changed)
            if ($articlesPrestation->getShop() === $this) {
                $articlesPrestation->setShop(null);
            }
        }

        return $this;
    }

    public function getCreatedAt():DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
    /**
     * @ORM\PrePersist
     */
    public function beforPersist():void
    {
        $this->libelle=AppService::capitalize($this->libelle);
        $this->createdAt=new \DateTime();
    }
    public function __toString():string
    {
        return $this->libelle;
    }
}
