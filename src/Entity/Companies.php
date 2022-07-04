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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeClient;

    /**
     * @ORM\OneToMany(targetEntity=ItemsSheets::class, mappedBy="company")
     */
    private $itemsSheets;

    /**
     * @ORM\OneToMany(targetEntity=CustomersSheets::class, mappedBy="company")
     */
    private $customersSheets;

    public function __construct()
    {
        $this->itemsSheets = new ArrayCollection();
        $this->customersSheets = new ArrayCollection();
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

    public function getCodeClient(): ?string
    {
        return $this->codeClient;
    }

    public function setCodeClient(?string $codeClient): self
    {
        $this->codeClient = $codeClient;

        return $this;
    }

    /**
     * @return Collection<int, ItemsSheets>
     */
    public function getItemsSheets(): Collection
    {
        return $this->itemsSheets;
    }

    public function addItemsSheet(ItemsSheets $itemsSheet): self
    {
        if (!$this->itemsSheets->contains($itemsSheet)) {
            $this->itemsSheets[] = $itemsSheet;
            $itemsSheet->setCompany($this);
        }

        return $this;
    }

    public function removeItemsSheet(ItemsSheets $itemsSheet): self
    {
        if ($this->itemsSheets->removeElement($itemsSheet)) {
            // set the owning side to null (unless already changed)
            if ($itemsSheet->getCompany() === $this) {
                $itemsSheet->setCompany(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CustomersSheets>
     */
    public function getCustomersSheets(): Collection
    {
        return $this->customersSheets;
    }

    public function addCustomersSheet(CustomersSheets $customersSheet): self
    {
        if (!$this->customersSheets->contains($customersSheet)) {
            $this->customersSheets[] = $customersSheet;
            $customersSheet->setCompany($this);
        }

        return $this;
    }

    public function removeCustomersSheet(CustomersSheets $customersSheet): self
    {
        if ($this->customersSheets->removeElement($customersSheet)) {
            // set the owning side to null (unless already changed)
            if ($customersSheet->getCompany() === $this) {
                $customersSheet->setCompany(null);
            }
        }

        return $this;
    }
}
