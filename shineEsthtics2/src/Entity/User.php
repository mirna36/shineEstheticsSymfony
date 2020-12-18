<?php

namespace App\Entity;

use App\Repository\UserRepository;
use App\Service\AppService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository", repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="L'utilisateur existe déjà dans le sistème ")
 * @ORM\HasLifecycleCallbacks
 * @param UserPasswordEncoderInterface $encoder
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(message="Le format de la saisie n'est pas conforme")
     * @Assert\NotBlank(message="merci de saisir votre email")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
    */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Veuillez renseigner votre nom")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Merci de renseigner votre numero de télèphone!")
     * @Assert\Length(min=" 9", minMessage="merci de saisir au moins 10 caractères")
     */
    private $telephone;
    /**
     * @var string
     */
    private $nomComplet;


    /**
     * @var string
     * @Assert\Length(min="4", minMessage="merci de saisir au moins 4 caractères")
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private  $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Adresse::class, mappedBy="user", orphanRemoval=true)
     */
    private $adresses;

    public function __construct()
    {
        $this->adresses = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

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
    public function getNomComplet(): string
    {
        return $this->nomComplet;
    }
/**
 * @ORM\PrePersist
 */
public function beforPersist():void
{
    $this->prenom=AppService::capitalize($this->prenom);
    $this->nom=AppService::uppercase($this->nom);
    $this->nomComplet=AppService::concatene($this->prenom, $this->nom);
    $this->email=AppService::lowercase($this->email);
    $this->createdAt=new \DateTime();



}
    /**
     * @ORM\PostLoad()
     */
public function apresChargement(){
    $this->nomComplet=AppService::concatene($this->prenom, $this->nom);
}
public function __toString():string
{
    return $this->nom;
}

/**
 * @return Collection|Adresse[]
 */
public function getAdresses(): Collection
{
    return $this->adresses;
}

public function addAdress(Adresse $adress): self
{
    if (!$this->adresses->contains($adress)) {
        $this->adresses[] = $adress;
        $adress->setUser($this);
    }

    return $this;
}

public function removeAdress(Adresse $adress): self
{
    if ($this->adresses->removeElement($adress)) {
        // set the owning side to null (unless already changed)
        if ($adress->getUser() === $this) {
            $adress->setUser(null);
        }
    }

    return $this;
}

}
