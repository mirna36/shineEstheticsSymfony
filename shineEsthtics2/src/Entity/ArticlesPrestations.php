<?php

namespace App\Entity;

use App\Repository\ArticlesPrestationsRepository;
use App\Service\AppService;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesPrestationsRepository", repositoryClass=ArticlesPrestationsRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class ArticlesPrestations
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $libelle;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_unit;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private  $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $disponible;

    /**
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="articlesPrestations")
     */
    private $categories;

    /**
     * @ORM\ManyToOne(targetEntity=SousCategories::class, inversedBy="articlesPrestations")
     */
    private $sousCategories;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $devis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $nomPhoto;

    /**
     * @Vich\UploadableField(mapping="img_products", fileNameProperty="nomPhoto")
     * @var File|null
     */
    private $fichierPhoto;

    /**
     * @ORM\OneToMany(targetEntity=PieceJointe::class, mappedBy="articlePrestation",cascade={"persist"})
     */
    private $pieceJointes;

    public function __construct()
    {
        $this->pieceJointes = new ArrayCollection();
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

    public function getPrixUnit(): ?string
    {
        return $this->prix_unit;
    }

    public function setPrixUnit(string $prix_unit): self
    {
        $this->prix_unit = $prix_unit;

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
        $this->libelle=AppService::lowercase($this->libelle);
        $this->createdAt=new DateTime();
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

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(?bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
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

    public function getSousCategories(): ?SousCategories
    {
        return $this->sousCategories;
    }

    public function setSousCategories(?SousCategories $sousCategories): self
    {
        $this->sousCategories = $sousCategories;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDevis(): ?bool
    {
        return $this->devis;
    }

    public function setDevis(?bool $devis): self
    {
        $this->devis = $devis;

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

    /**
     * @return Collection|PieceJointe[]
     */
    public function getPieceJointes(): Collection
    {
        return $this->pieceJointes;
    }

    public function addPieceJointe(PieceJointe $pieceJointe): self
    {
        if (!$this->pieceJointes->contains($pieceJointe)) {
            $this->pieceJointes[] = $pieceJointe;
            $pieceJointe->setArticlePrestation($this);
        }

        return $this;
    }

    public function removePieceJointe(PieceJointe $pieceJointe): self
    {
        if ($this->pieceJointes->removeElement($pieceJointe)) {
            // set the owning side to null (unless already changed)
            if ($pieceJointe->getArticlePrestation() === $this) {
                $pieceJointe->setArticlePrestation(null);
            }
        }

        return $this;
    }







}
