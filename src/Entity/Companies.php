<?php

namespace App\Entity;

use App\Repository\CompaniesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompaniesRepository::class)
 */
class Companies
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
    private $name;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $colorCode;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $databaseName;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $colorText;

    /**
     * @ORM\OneToMany(targetEntity=FicheArticle::class, mappedBy="company")
     */
    private $ficheArticles;

    /**
     * @ORM\OneToMany(targetEntity=FicheClient::class, mappedBy="company")
     */
    private $ficheClients;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeClient;

    public function __construct()
    {
        $this->ficheArticles = new ArrayCollection();
        $this->ficheClients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getColorCode(): ?string
    {
        return $this->colorCode;
    }

    public function setColorCode(string $colorCode): self
    {
        $this->colorCode = $colorCode;

        return $this;
    }

    public function getDatabaseName(): ?string
    {
        return $this->databaseName;
    }

    public function setDatabaseName(string $databaseName): self
    {
        $this->databaseName = $databaseName;

        return $this;
    }

    public function getColorText(): ?string
    {
        return $this->colorText;
    }

    public function setColorText(?string $colorText): self
    {
        $this->colorText = $colorText;

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
            $ficheArticle->setCompany($this);
        }

        return $this;
    }

    public function removeFicheArticle(FicheArticle $ficheArticle): self
    {
        if ($this->ficheArticles->removeElement($ficheArticle)) {
            // set the owning side to null (unless already changed)
            if ($ficheArticle->getCompany() === $this) {
                $ficheArticle->setCompany(null);
            }
        }

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
            $ficheClient->setCompany($this);
        }

        return $this;
    }

    public function removeFicheClient(FicheClient $ficheClient): self
    {
        if ($this->ficheClients->removeElement($ficheClient)) {
            // set the owning side to null (unless already changed)
            if ($ficheClient->getCompany() === $this) {
                $ficheClient->setCompany(null);
            }
        }

        return $this;
    }

    public function getCodeClient(): ?string
    {
        return $this->codeClient;
    }

    public function setCodeClient(?string $codeClient): self
    {
        $this->codeClient = $codeClient;

        return $this;
    }
}
