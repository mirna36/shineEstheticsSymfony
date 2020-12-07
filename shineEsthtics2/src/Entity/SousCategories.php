<?php

namespace App\Entity;

use App\Repository\SousCategoriesRepository;
use App\Service\AppService;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=SousCategoriesRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class SousCategories
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
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=ArticlesPrestations::class, mappedBy="sousCategories")
     */
    private $articlesPrestations;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="sousCategories")
     */
    private $categories;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomPhoto;
     /**
      * @Vich\UploadableField(mapping="img_products", fileNameProperty="nomPhoto")
      * @var File|null
      */
    private $fichierPhoto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;


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

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    /**
     * @ORM\PrePersist
     */
    public function beforPersist():void
    {
        $this->libelle=AppService::capitalize($this->libelle);
        $this->createdAt=new \DateTime();
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
            $articlesPrestation->setSousCategories($this);
        }

        return $this;
    }

    public function removeArticlesPrestation(ArticlesPrestations $articlesPrestation): self
    {
        if ($this->articlesPrestations->removeElement($articlesPrestation)) {
            // set the owning side to null (unless already changed)
            if ($articlesPrestation->getSousCategories() === $this) {
                $articlesPrestation->setSousCategories(null);
            }
        }

        return $this;
    }
    public function __toString():string
    {
        return $this->libelle;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getNomPhoto(): ?string
    {
        return $this->nomPhoto;
    }

    public function setNomPhoto(?string $nomPhoto): self
    {
        $this->nomPhoto = $nomPhoto;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFichierPhoto(): ?File
    {
        return $this->fichierPhoto;
    }

    /**
     * @param File|null $fichierPhoto
     */
    public function setFichierPhoto(?File $fichierPhoto): void
    {
        $this->fichierPhoto = $fichierPhoto;
        if($fichierPhoto){
            $this->createdAt=new DateTime();
        }
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
