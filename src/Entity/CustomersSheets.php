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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mailInvoice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $customerRate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $autoSendRate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $deliveryDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pvc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coefPVC;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $payAdvanced;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $payBankCheck;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $payPayment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $paySampling;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extKBIS;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extCGV;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extAUTHPREV;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extRIB;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $extOTHERDOCU;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctDirName;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $ctDirPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctDirMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctComptaName;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $ctComptaPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctComptaMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctComName;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $ctComPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctComMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctQuaName;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $ctQuaPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctQuaMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctSecName;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $ctSecPhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctSecMail;

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

    public function getMailInvoice(): ?string
    {
        return $this->mailInvoice;
    }

    public function setMailInvoice(?string $mailInvoice): self
    {
        $this->mailInvoice = $mailInvoice;

        return $this;
    }

    public function getCustomerRate(): ?string
    {
        return $this->customerRate;
    }

    public function setCustomerRate(?string $customerRate): self
    {
        $this->customerRate = $customerRate;

        return $this;
    }

    public function getAutoSendRate(): ?int
    {
        return $this->autoSendRate;
    }

    public function setAutoSendRate(?int $autoSendRate): self
    {
        $this->autoSendRate = $autoSendRate;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(?\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getPvc(): ?int
    {
        return $this->pvc;
    }

    public function setPvc(?int $pvc): self
    {
        $this->pvc = $pvc;

        return $this;
    }

    public function getCoefPVC(): ?string
    {
        return $this->coefPVC;
    }

    public function setCoefPVC(?string $coefPVC): self
    {
        $this->coefPVC = $coefPVC;

        return $this;
    }

    public function getPayAdvanced(): ?int
    {
        return $this->payAdvanced;
    }

    public function setPayAdvanced(?int $payAdvanced): self
    {
        $this->payAdvanced = $payAdvanced;

        return $this;
    }

    public function getPayBankCheck(): ?int
    {
        return $this->payBankCheck;
    }

    public function setPayBankCheck(?int $payBankCheck): self
    {
        $this->payBankCheck = $payBankCheck;

        return $this;
    }

    public function getPayPayment(): ?int
    {
        return $this->payPayment;
    }

    public function setPayPayment(?int $payPayment): self
    {
        $this->payPayment = $payPayment;

        return $this;
    }

    public function getPaySampling(): ?int
    {
        return $this->paySampling;
    }

    public function setPaySampling(?int $paySampling): self
    {
        $this->paySampling = $paySampling;

        return $this;
    }

    public function getExtKBIS(): ?string
    {
        return $this->extKBIS;
    }

    public function setExtKBIS(?string $extKBIS): self
    {
        $this->extKBIS = $extKBIS;

        return $this;
    }

    public function getExtCGV(): ?string
    {
        return $this->extCGV;
    }

    public function setExtCGV(?string $extCGV): self
    {
        $this->extCGV = $extCGV;

        return $this;
    }

    public function getExtAUTHPREV(): ?string
    {
        return $this->extAUTHPREV;
    }

    public function setExtAUTHPREV(?string $extAUTHPREV): self
    {
        $this->extAUTHPREV = $extAUTHPREV;

        return $this;
    }

    public function getExtRIB(): ?string
    {
        return $this->extRIB;
    }

    public function setExtRIB(?string $extRIB): self
    {
        $this->extRIB = $extRIB;

        return $this;
    }

    public function getExtOTHERDOCU(): ?string
    {
        return $this->extOTHERDOCU;
    }

    public function setExtOTHERDOCU(?string $extOTHERDOCU): self
    {
        $this->extOTHERDOCU = $extOTHERDOCU;

        return $this;
    }

    public function getCtDirName(): ?string
    {
        return $this->ctDirName;
    }

    public function setCtDirName(?string $ctDirName): self
    {
        $this->ctDirName = $ctDirName;

        return $this;
    }

    public function getCtDirPhone(): ?string
    {
        return $this->ctDirPhone;
    }

    public function setCtDirPhone(?string $ctDirPhone): self
    {
        $this->ctDirPhone = $ctDirPhone;

        return $this;
    }

    public function getCtDirMail(): ?string
    {
        return $this->ctDirMail;
    }

    public function setCtDirMail(?string $ctDirMail): self
    {
        $this->ctDirMail = $ctDirMail;

        return $this;
    }

    public function getCtComptaName(): ?string
    {
        return $this->ctComptaName;
    }

    public function setCtComptaName(?string $ctComptaName): self
    {
        $this->ctComptaName = $ctComptaName;

        return $this;
    }

    public function getCtComptaPhone(): ?string
    {
        return $this->ctComptaPhone;
    }

    public function setCtComptaPhone(?string $ctComptaPhone): self
    {
        $this->ctComptaPhone = $ctComptaPhone;

        return $this;
    }

    public function getCtComptaMail(): ?string
    {
        return $this->ctComptaMail;
    }

    public function setCtComptaMail(?string $ctComptaMail): self
    {
        $this->ctComptaMail = $ctComptaMail;

        return $this;
    }

    public function getCtComName(): ?string
    {
        return $this->ctComName;
    }

    public function setCtComName(?string $ctComName): self
    {
        $this->ctComName = $ctComName;

        return $this;
    }

    public function getCtComPhone(): ?string
    {
        return $this->ctComPhone;
    }

    public function setCtComPhone(?string $ctComPhone): self
    {
        $this->ctComPhone = $ctComPhone;

        return $this;
    }

    public function getCtComMail(): ?string
    {
        return $this->ctComMail;
    }

    public function setCtComMail(?string $ctComMail): self
    {
        $this->ctComMail = $ctComMail;

        return $this;
    }

    public function getCtQuaName(): ?string
    {
        return $this->ctQuaName;
    }

    public function setCtQuaName(?string $ctQuaName): self
    {
        $this->ctQuaName = $ctQuaName;

        return $this;
    }

    public function getCtQuaPhone(): ?string
    {
        return $this->ctQuaPhone;
    }

    public function setCtQuaPhone(?string $ctQuaPhone): self
    {
        $this->ctQuaPhone = $ctQuaPhone;

        return $this;
    }

    public function getCtQuaMail(): ?string
    {
        return $this->ctQuaMail;
    }

    public function setCtQuaMail(?string $ctQuaMail): self
    {
        $this->ctQuaMail = $ctQuaMail;

        return $this;
    }

    public function getCtSecName(): ?string
    {
        return $this->ctSecName;
    }

    public function setCtSecName(?string $ctSecName): self
    {
        $this->ctSecName = $ctSecName;

        return $this;
    }

    public function getCtSecPhone(): ?string
    {
        return $this->ctSecPhone;
    }

    public function setCtSecPhone(?string $ctSecPhone): self
    {
        $this->ctSecPhone = $ctSecPhone;

        return $this;
    }

    public function getCtSecMail(): ?string
    {
        return $this->ctSecMail;
    }

    public function setCtSecMail(?string $ctSecMail): self
    {
        $this->ctSecMail = $ctSecMail;

        return $this;
    }
}
