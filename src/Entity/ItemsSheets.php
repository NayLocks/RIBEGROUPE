<?php

namespace App\Entity;

use App\Repository\ItemsSheetsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemsSheetsRepository::class)
 */
class ItemsSheets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Companies::class, inversedBy="itemsSheets")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="itemsSheets")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $generic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $variety;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $origin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $diameter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $packaging;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $groupItem;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $step;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fishingNameLatin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fishingArea;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stat1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stat2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stat3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $stat4;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $weightPackaging;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weightVariable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $unitPackaging;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $unitVariable;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dlc;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $ddm;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dlcDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $noticeAccentuate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $localization;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rup;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siqo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $unitPurchase;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $unitSale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $unitStock;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateLastChange;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateReceipt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateValidation;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="itemsSheetsValidation")
     */
    private $usernameValidation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reasonRefusal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeArticle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeSodexo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeSXO;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUsername(): ?User
    {
        return $this->username;
    }

    public function setUsername(?User $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getGeneric(): ?string
    {
        return $this->generic;
    }

    public function setGeneric(?string $generic): self
    {
        $this->generic = $generic;

        return $this;
    }

    public function getVariety(): ?string
    {
        return $this->variety;
    }

    public function setVariety(?string $variety): self
    {
        $this->variety = $variety;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(?string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getDiameter(): ?string
    {
        return $this->diameter;
    }

    public function setDiameter(?string $diameter): self
    {
        $this->diameter = $diameter;

        return $this;
    }

    public function getPackaging(): ?string
    {
        return $this->packaging;
    }

    public function setPackaging(?string $packaging): self
    {
        $this->packaging = $packaging;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getGroupItem(): ?string
    {
        return $this->groupItem;
    }

    public function setGroupItem(?string $groupItem): self
    {
        $this->groupItem = $groupItem;

        return $this;
    }

    public function getStep(): ?string
    {
        return $this->step;
    }

    public function setStep(?string $step): self
    {
        $this->step = $step;

        return $this;
    }

    public function getFishingNameLatin(): ?string
    {
        return $this->fishingNameLatin;
    }

    public function setFishingNameLatin(?string $fishingNameLatin): self
    {
        $this->fishingNameLatin = $fishingNameLatin;

        return $this;
    }

    public function getFishingArea(): ?string
    {
        return $this->fishingArea;
    }

    public function setFishingArea(?string $fishingArea): self
    {
        $this->fishingArea = $fishingArea;

        return $this;
    }

    public function getStat1(): ?string
    {
        return $this->stat1;
    }

    public function setStat1(?string $stat1): self
    {
        $this->stat1 = $stat1;

        return $this;
    }

    public function getStat2(): ?string
    {
        return $this->stat2;
    }

    public function setStat2(?string $stat2): self
    {
        $this->stat2 = $stat2;

        return $this;
    }

    public function getStat3(): ?string
    {
        return $this->stat3;
    }

    public function setStat3(?string $stat3): self
    {
        $this->stat3 = $stat3;

        return $this;
    }

    public function getStat4(): ?string
    {
        return $this->stat4;
    }

    public function setStat4(?string $stat4): self
    {
        $this->stat4 = $stat4;

        return $this;
    }

    public function getWeightPackaging(): ?string
    {
        return $this->weightPackaging;
    }

    public function setWeightPackaging(?string $weightPackaging): self
    {
        $this->weightPackaging = $weightPackaging;

        return $this;
    }

    public function getWeightVariable(): ?int
    {
        return $this->weightVariable;
    }

    public function setWeightVariable(?int $weightVariable): self
    {
        $this->weightVariable = $weightVariable;

        return $this;
    }

    public function getUnitPackaging(): ?string
    {
        return $this->unitPackaging;
    }

    public function setUnitPackaging(?string $unitPackaging): self
    {
        $this->unitPackaging = $unitPackaging;

        return $this;
    }

    public function getUnitVariable(): ?int
    {
        return $this->unitVariable;
    }

    public function setUnitVariable(?int $unitVariable): self
    {
        $this->unitVariable = $unitVariable;

        return $this;
    }

    public function getDlc(): ?int
    {
        return $this->dlc;
    }

    public function setDlc(?int $dlc): self
    {
        $this->dlc = $dlc;

        return $this;
    }

    public function getDdm(): ?int
    {
        return $this->ddm;
    }

    public function setDdm(?int $ddm): self
    {
        $this->ddm = $ddm;

        return $this;
    }

    public function getDlcDate(): ?string
    {
        return $this->dlcDate;
    }

    public function setDlcDate(?string $dlcDate): self
    {
        $this->dlcDate = $dlcDate;

        return $this;
    }

    public function getNoticeAccentuate(): ?string
    {
        return $this->noticeAccentuate;
    }

    public function setNoticeAccentuate(?string $noticeAccentuate): self
    {
        $this->noticeAccentuate = $noticeAccentuate;

        return $this;
    }

    public function getLocalization(): ?string
    {
        return $this->localization;
    }

    public function setLocalization(?string $localization): self
    {
        $this->localization = $localization;

        return $this;
    }

    public function getRup(): ?string
    {
        return $this->rup;
    }

    public function setRup(?string $rup): self
    {
        $this->rup = $rup;

        return $this;
    }

    public function getSiqo(): ?string
    {
        return $this->siqo;
    }

    public function setSiqo(string $siqo): self
    {
        $this->siqo = $siqo;

        return $this;
    }

    public function getUnitPurchase(): ?string
    {
        return $this->unitPurchase;
    }

    public function setUnitPurchase(?string $unitPurchase): self
    {
        $this->unitPurchase = $unitPurchase;

        return $this;
    }

    public function getUnitSale(): ?string
    {
        return $this->unitSale;
    }

    public function setUnitSale(?string $unitSale): self
    {
        $this->unitSale = $unitSale;

        return $this;
    }

    public function getUnitStock(): ?string
    {
        return $this->unitStock;
    }

    public function setUnitStock(?string $unitStock): self
    {
        $this->unitStock = $unitStock;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(?\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateLastChange(): ?\DateTimeInterface
    {
        return $this->dateLastChange;
    }

    public function setDateLastChange(?\DateTimeInterface $dateLastChange): self
    {
        $this->dateLastChange = $dateLastChange;

        return $this;
    }

    public function getDateReceipt(): ?\DateTimeInterface
    {
        return $this->dateReceipt;
    }

    public function setDateReceipt(?\DateTimeInterface $dateReceipt): self
    {
        $this->dateReceipt = $dateReceipt;

        return $this;
    }

    public function getDateValidation(): ?\DateTimeInterface
    {
        return $this->dateValidation;
    }

    public function setDateValidation(?\DateTimeInterface $dateValidation): self
    {
        $this->dateValidation = $dateValidation;

        return $this;
    }

    public function getUsernameValidation(): ?User
    {
        return $this->usernameValidation;
    }

    public function setUsernameValidation(?User $usernameValidation): self
    {
        $this->usernameValidation = $usernameValidation;

        return $this;
    }

    public function getReasonRefusal(): ?string
    {
        return $this->reasonRefusal;
    }

    public function setReasonRefusal(?string $reasonRefusal): self
    {
        $this->reasonRefusal = $reasonRefusal;

        return $this;
    }

    public function getCodeArticle(): ?string
    {
        return $this->codeArticle;
    }

    public function setCodeArticle(?string $codeArticle): self
    {
        $this->codeArticle = $codeArticle;

        return $this;
    }

    public function getCodeSodexo(): ?string
    {
        return $this->codeSodexo;
    }

    public function setCodeSodexo(?string $codeSodexo): self
    {
        $this->codeSodexo = $codeSodexo;

        return $this;
    }

    public function getCodeSXO(): ?string
    {
        return $this->codeSXO;
    }

    public function setCodeSXO(?string $codeSXO): self
    {
        $this->codeSXO = $codeSXO;

        return $this;
    }
}
