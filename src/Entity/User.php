<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
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
     */
    private $username;

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
     * @ORM\ManyToOne(targetEntity=Companies::class, inversedBy="users")
     */
    private $company;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $accessFC;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $accessFA;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $accessFF;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $accessADM;

    /**
     * @ORM\OneToMany(targetEntity=FicheArticle::class, mappedBy="username")
     */
    private $ficheArticles;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleFC;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleFA;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleFF;

    /**
     * @ORM\OneToMany(targetEntity=FicheClient::class, mappedBy="username")
     */
    private $ficheClients;

    public function __construct()
    {
        $this->ficheArticles = new ArrayCollection();
        $this->ficheClients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCompany(): ?Companies
    {
        return $this->company;
    }

    public function setCompany(?Companies $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
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

    public function getAccessFC(): ?int
    {
        return $this->accessFC;
    }

    public function setAccessFC(int $accessFC): self
    {
        $this->accessFC = $accessFC;

        return $this;
    }

    public function getAccessFA(): ?int
    {
        return $this->accessFA;
    }

    public function setAccessFA(int $accessFA): self
    {
        $this->accessFA = $accessFA;

        return $this;
    }

    public function getAccessFF(): ?int
    {
        return $this->accessFF;
    }

    public function setAccessFF(int $accessFF): self
    {
        $this->accessFF = $accessFF;

        return $this;
    }

    public function getAccessADM(): ?int
    {
        return $this->accessADM;
    }

    public function setAccessADM(?int $accessADM): self
    {
        $this->accessADM = $accessADM;

        return $this;
    }

    /**
     * @return Collection<int, FicheArticle>
     */
    public function getFicheArticles(): Collection
    {
        return $this->ficheArticles;
    }

    public function addFicheArticle(FicheArticle $ficheArticle): self
    {
        if (!$this->ficheArticles->contains($ficheArticle)) {
            $this->ficheArticles[] = $ficheArticle;
            $ficheArticle->setUsername($this);
        }

        return $this;
    }

    public function removeFicheArticle(FicheArticle $ficheArticle): self
    {
        if ($this->ficheArticles->removeElement($ficheArticle)) {
            // set the owning side to null (unless already changed)
            if ($ficheArticle->getUsername() === $this) {
                $ficheArticle->setUsername(null);
            }
        }

        return $this;
    }

    public function getTitleFC(): ?string
    {
        return $this->titleFC;
    }

    public function setTitleFC(string $titleFC): self
    {
        $this->titleFC = $titleFC;

        return $this;
    }

    public function getTitleFA(): ?string
    {
        return $this->titleFA;
    }

    public function setTitleFA(string $titleFA): self
    {
        $this->titleFA = $titleFA;

        return $this;
    }

    public function getTitleFF(): ?string
    {
        return $this->titleFF;
    }

    public function setTitleFF(string $titleFF): self
    {
        $this->titleFF = $titleFF;

        return $this;
    }

    /**
     * @return Collection<int, FicheClient>
     */
    public function getFicheClients(): Collection
    {
        return $this->ficheClients;
    }

    public function addFicheClient(FicheClient $ficheClient): self
    {
        if (!$this->ficheClients->contains($ficheClient)) {
            $this->ficheClients[] = $ficheClient;
            $ficheClient->setUsername($this);
        }

        return $this;
    }

    public function removeFicheClient(FicheClient $ficheClient): self
    {
        if ($this->ficheClients->removeElement($ficheClient)) {
            // set the owning side to null (unless already changed)
            if ($ficheClient->getUsername() === $this) {
                $ficheClient->setUsername(null);
            }
        }

        return $this;
    }
}
