<?php

namespace App\Entity;

use App\Repository\StepsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StepsRepository::class)
 */
class Steps
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $colorCode;

    /**
     * @ORM\OneToMany(targetEntity=CustomersSheets::class, mappedBy="step")
     */
    private $customersSheets;

    public function __construct()
    {
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

    public function setColorCode(?string $colorCode): self
    {
        $this->colorCode = $colorCode;

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
            $customersSheet->setStep($this);
        }

        return $this;
    }

    public function removeCustomersSheet(CustomersSheets $customersSheet): self
    {
        if ($this->customersSheets->removeElement($customersSheet)) {
            // set the owning side to null (unless already changed)
            if ($customersSheet->getStep() === $this) {
                $customersSheet->setStep(null);
            }
        }

        return $this;
    }
}
