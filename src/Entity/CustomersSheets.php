<?php

namespace App\Entity;

use App\Repository\CustomersSheetsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomersSheetsRepository::class)
 */
class CustomersSheets
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Companies::class, inversedBy="customersSheets")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="customersSheets")
     */
    private $username;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $customerCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $oldCustomerCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $accountBrother;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $account_fl;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $account_45g;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $account_tide;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $account_bof;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $callName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeManagement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $socialReason;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nameAccount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $deliveryAddress;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $deliveryAddressZipCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $deliveryAddressCity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siret;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tva;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $customerType;

    /**
     * @ORM\ManyToOne(targetEntity=Steps::class, inversedBy="customersSheets")
     */
    private $step;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commitmentNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $serviceCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $invoiceAddress;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $invoiceAddressZipCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $invoiceAddressCity;

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
    private $stat5;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $phoneStandard;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phoneStandardTel;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $phoneMobile;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phoneMobileTel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mailStandard;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $callCustomer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $callMonday;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $callTuesday;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $callWednesday;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $callThursday;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $callFriday;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $callSaturday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hoursMonday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hoursTuesday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hoursWednesday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hoursThursday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hoursFriday;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hoursSaturday;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $faxStandard;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siren;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCustomerCode(): ?string
    {
        return $this->customerCode;
    }

    public function setCustomerCode(?string $customerCode): self
    {
        $this->customerCode = $customerCode;

        return $this;
    }

    public function getOldCustomerCode(): ?string
    {
        return $this->oldCustomerCode;
    }

    public function setOldCustomerCode(?string $oldCustomerCode): self
    {
        $this->oldCustomerCode = $oldCustomerCode;

        return $this;
    }

    public function getAccountBrother(): ?string
    {
        return $this->accountBrother;
    }

    public function setAccountBrother(?string $accountBrother): self
    {
        $this->accountBrother = $accountBrother;

        return $this;
    }

    public function getAccountFl(): ?int
    {
        return $this->account_fl;
    }

    public function setAccountFl(?int $account_fl): self
    {
        $this->account_fl = $account_fl;

        return $this;
    }

    public function getAccount45g(): ?int
    {
        return $this->account_45g;
    }

    public function setAccount45g(?int $account_45g): self
    {
        $this->account_45g = $account_45g;

        return $this;
    }

    public function getAccountTide(): ?int
    {
        return $this->account_tide;
    }

    public function setAccountTide(?int $account_tide): self
    {
        $this->account_tide = $account_tide;

        return $this;
    }

    public function getAccountBof(): ?int
    {
        return $this->account_bof;
    }

    public function setAccountBof(?int $account_bof): self
    {
        $this->account_bof = $account_bof;

        return $this;
    }

    public function getCallName(): ?string
    {
        return $this->callName;
    }

    public function setCallName(?string $callName): self
    {
        $this->callName = $callName;

        return $this;
    }

    public function getCodeManagement(): ?string
    {
        return $this->codeManagement;
    }

    public function setCodeManagement(?string $codeManagement): self
    {
        $this->codeManagement = $codeManagement;

        return $this;
    }

    public function getSocialReason(): ?string
    {
        return $this->socialReason;
    }

    public function setSocialReason(?string $socialReason): self
    {
        $this->socialReason = $socialReason;

        return $this;
    }

    public function getNameAccount(): ?string
    {
        return $this->nameAccount;
    }

    public function setNameAccount(?string $nameAccount): self
    {
        $this->nameAccount = $nameAccount;

        return $this;
    }

    public function getDeliveryAddress(): ?string
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(?string $deliveryAddress): self
    {
        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    public function getDeliveryAddressZipCode(): ?string
    {
        return $this->deliveryAddressZipCode;
    }

    public function setDeliveryAddressZipCode(?string $deliveryAddressZipCode): self
    {
        $this->deliveryAddressZipCode = $deliveryAddressZipCode;

        return $this;
    }

    public function getDeliveryAddressCity(): ?string
    {
        return $this->deliveryAddressCity;
    }

    public function setDeliveryAddressCity(?string $deliveryAddressCity): self
    {
        $this->deliveryAddressCity = $deliveryAddressCity;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(?string $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getCustomerType(): ?int
    {
        return $this->customerType;
    }

    public function setCustomerType(?int $customerType): self
    {
        $this->customerType = $customerType;

        return $this;
    }

    public function getStep(): ?Steps
    {
        return $this->step;
    }

    public function setStep(?Steps $step): self
    {
        $this->step = $step;

        return $this;
    }

    public function getCommitmentNumber(): ?string
    {
        return $this->commitmentNumber;
    }

    public function setCommitmentNumber(?string $commitmentNumber): self
    {
        $this->commitmentNumber = $commitmentNumber;

        return $this;
    }

    public function getServiceCode(): ?string
    {
        return $this->serviceCode;
    }

    public function setServiceCode(?string $serviceCode): self
    {
        $this->serviceCode = $serviceCode;

        return $this;
    }

    public function getInvoiceAddress(): ?string
    {
        return $this->invoiceAddress;
    }

    public function setInvoiceAddress(?string $invoiceAddress): self
    {
        $this->invoiceAddress = $invoiceAddress;

        return $this;
    }

    public function getInvoiceAddressZipCode(): ?string
    {
        return $this->invoiceAddressZipCode;
    }

    public function setInvoiceAddressZipCode(?string $invoiceAddressZipCode): self
    {
        $this->invoiceAddressZipCode = $invoiceAddressZipCode;

        return $this;
    }

    public function getInvoiceAddressCity(): ?string
    {
        return $this->invoiceAddressCity;
    }

    public function setInvoiceAddressCity(?string $invoiceAddressCity): self
    {
        $this->invoiceAddressCity = $invoiceAddressCity;

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

    public function getStat5(): ?string
    {
        return $this->stat5;
    }

    public function setStat5(?string $stat5): self
    {
        $this->stat5 = $stat5;

        return $this;
    }

    public function getPhoneStandard(): ?string
    {
        return $this->phoneStandard;
    }

    public function setPhoneStandard(?string $phoneStandard): self
    {
        $this->phoneStandard = $phoneStandard;

        return $this;
    }

    public function getPhoneStandardTel(): ?int
    {
        return $this->phoneStandardTel;
    }

    public function setPhoneStandardTel(?int $phoneStandardTel): self
    {
        $this->phoneStandardTel = $phoneStandardTel;

        return $this;
    }

    public function getPhoneMobile(): ?string
    {
        return $this->phoneMobile;
    }

    public function setPhoneMobile(?string $phoneMobile): self
    {
        $this->phoneMobile = $phoneMobile;

        return $this;
    }

    public function getPhoneMobileTel(): ?int
    {
        return $this->phoneMobileTel;
    }

    public function setPhoneMobileTel(?int $phoneMobileTel): self
    {
        $this->phoneMobileTel = $phoneMobileTel;

        return $this;
    }

    public function getMailStandard(): ?string
    {
        return $this->mailStandard;
    }

    public function setMailStandard(?string $mailStandard): self
    {
        $this->mailStandard = $mailStandard;

        return $this;
    }

    public function getCallCustomer(): ?int
    {
        return $this->callCustomer;
    }

    public function setCallCustomer(?int $callCustomer): self
    {
        $this->callCustomer = $callCustomer;

        return $this;
    }

    public function getCallMonday(): ?int
    {
        return $this->callMonday;
    }

    public function setCallMonday(?int $callMonday): self
    {
        $this->callMonday = $callMonday;

        return $this;
    }

    public function getCallTuesday(): ?int
    {
        return $this->callTuesday;
    }

    public function setCallTuesday(?int $callTuesday): self
    {
        $this->callTuesday = $callTuesday;

        return $this;
    }

    public function getCallWednesday(): ?int
    {
        return $this->callWednesday;
    }

    public function setCallWednesday(?int $callWednesday): self
    {
        $this->callWednesday = $callWednesday;

        return $this;
    }

    public function getCallThursday(): ?int
    {
        return $this->callThursday;
    }

    public function setCallThursday(?int $callThursday): self
    {
        $this->callThursday = $callThursday;

        return $this;
    }

    public function getCallFriday(): ?int
    {
        return $this->callFriday;
    }

    public function setCallFriday(?int $callFriday): self
    {
        $this->callFriday = $callFriday;

        return $this;
    }

    public function getCallSaturday(): ?int
    {
        return $this->callSaturday;
    }

    public function setCallSaturday(?int $callSaturday): self
    {
        $this->callSaturday = $callSaturday;

        return $this;
    }

    public function getHoursMonday(): ?string
    {
        return $this->hoursMonday;
    }

    public function setHoursMonday(?string $hoursMonday): self
    {
        $this->hoursMonday = $hoursMonday;

        return $this;
    }

    public function getHoursTuesday(): ?string
    {
        return $this->hoursTuesday;
    }

    public function setHoursTuesday(?string $hoursTuesday): self
    {
        $this->hoursTuesday = $hoursTuesday;

        return $this;
    }

    public function getHoursWednesday(): ?string
    {
        return $this->hoursWednesday;
    }

    public function setHoursWednesday(?string $hoursWednesday): self
    {
        $this->hoursWednesday = $hoursWednesday;

        return $this;
    }

    public function getHoursThursday(): ?string
    {
        return $this->hoursThursday;
    }

    public function setHoursThursday(?string $hoursThursday): self
    {
        $this->hoursThursday = $hoursThursday;

        return $this;
    }

    public function getHoursFriday(): ?string
    {
        return $this->hoursFriday;
    }

    public function setHoursFriday(?string $hoursFriday): self
    {
        $this->hoursFriday = $hoursFriday;

        return $this;
    }

    public function getHoursSaturday(): ?string
    {
        return $this->hoursSaturday;
    }

    public function setHoursSaturday(?string $hoursSaturday): self
    {
        $this->hoursSaturday = $hoursSaturday;

        return $this;
    }

    public function getFaxStandard(): ?string
    {
        return $this->faxStandard;
    }

    public function setFaxStandard(?string $faxStandard): self
    {
        $this->faxStandard = $faxStandard;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(?string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }
}
