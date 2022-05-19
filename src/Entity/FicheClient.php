<?php

namespace App\Entity;

use App\Repository\FicheClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FicheClientRepository::class)
 */
class FicheClient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Companies::class, inversedBy="ficheClients")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ficheClients")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $etapeFiche;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeClient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ancienCodeClient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $compteFrere;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cpFL;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cp45G;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cpMaree;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cpBOF;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomAppel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeGestion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raisonSocial;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomGrandCompte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adrLivraison;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $adrLivCodePostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adrLivVille;

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
    private $typeClient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $engagement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeService;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adrFacture;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $adrFacCodePostal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adrFacVille;

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
    private $phonePortable;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phonePortableTel;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $faxStandard;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailStandard;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $appelClient;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $appelLundi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horaireLundi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $appelMardi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horaireMardi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $appelMercredi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horaireMercredi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $appelJeudi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horaireJeudi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $appelVendredi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horaireVendredi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $appelSamedi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $horaireSamedi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailFacture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tarifClient;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $envoiTarifAuto;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date1Livraison;

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
    private $avance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cheque;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $virement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prelevement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ext_kbis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ext_cgv;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ext_auth;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ext_rib;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ext_autres;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctDirNom;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $ctDirTel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctDirMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctComptaNom;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $ctComptaTel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctComptaMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctComNom;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $ctComTel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctComMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctQuaNom;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $ctQuaTel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctQuaMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctSecNom;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $ctSecTel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ctSecMail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trLundi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trMardi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trMercredi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trJeudi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trVendredi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trSamedi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rgLundi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rgMardi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rgMercredi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rgJeudi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rgVendredi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rgSamedi;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $plageHoraire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dirCom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comMaitre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $com;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $taux1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $taux2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $taux3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nature1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nature2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nature3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $limiteFrais;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $montantFrais;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fraisDev;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $delaisReg;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $blocCompte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $companyTransport;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateValidDirection;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raisonRefus;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateReceptionDirecteur;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateReceptionLogistique;

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

    public function getEtapeFiche(): ?string
    {
        return $this->etapeFiche;
    }

    public function setEtapeFiche(string $etapeFiche): self
    {
        $this->etapeFiche = $etapeFiche;

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

    public function getCodeClient(): ?string
    {
        return $this->codeClient;
    }

    public function setCodeClient(?string $codeClient): self
    {
        $this->codeClient = $codeClient;

        return $this;
    }

    public function getAncienCodeClient(): ?string
    {
        return $this->ancienCodeClient;
    }

    public function setAncienCodeClient(?string $ancienCodeClient): self
    {
        $this->ancienCodeClient = $ancienCodeClient;

        return $this;
    }

    public function getCompteFrere(): ?string
    {
        return $this->compteFrere;
    }

    public function setCompteFrere(?string $compteFrere): self
    {
        $this->compteFrere = $compteFrere;

        return $this;
    }

    public function getCpFL(): ?int
    {
        return $this->cpFL;
    }

    public function setCpFL(int $cpFL): self
    {
        $this->cpFL = $cpFL;

        return $this;
    }

    public function getCp45G(): ?int
    {
        return $this->cp45G;
    }

    public function setCp45G(int $cp45G): self
    {
        $this->cp45G = $cp45G;

        return $this;
    }

    public function getCpMaree(): ?int
    {
        return $this->cpMaree;
    }

    public function setCpMaree(int $cpMaree): self
    {
        $this->cpMaree = $cpMaree;

        return $this;
    }

    public function getCpBOF(): ?int
    {
        return $this->cpBOF;
    }

    public function setCpBOF(int $cpBOF): self
    {
        $this->cpBOF = $cpBOF;

        return $this;
    }

    public function getNomAppel(): ?string
    {
        return $this->nomAppel;
    }

    public function setNomAppel(?string $nomAppel): self
    {
        $this->nomAppel = $nomAppel;

        return $this;
    }

    public function getCodeGestion(): ?string
    {
        return $this->codeGestion;
    }

    public function setCodeGestion(string $codeGestion): self
    {
        $this->codeGestion = $codeGestion;

        return $this;
    }

    public function getRaisonSocial(): ?string
    {
        return $this->raisonSocial;
    }

    public function setRaisonSocial(?string $raisonSocial): self
    {
        $this->raisonSocial = $raisonSocial;

        return $this;
    }

    public function getNomGrandCompte(): ?string
    {
        return $this->nomGrandCompte;
    }

    public function setNomGrandCompte(?string $nomGrandCompte): self
    {
        $this->nomGrandCompte = $nomGrandCompte;

        return $this;
    }

    public function getAdrLivraison(): ?string
    {
        return $this->adrLivraison;
    }

    public function setAdrLivraison(?string $adrLivraison): self
    {
        $this->adrLivraison = $adrLivraison;

        return $this;
    }

    public function getAdrLivCodePostal(): ?string
    {
        return $this->adrLivCodePostal;
    }

    public function setAdrLivCodePostal(?string $adrLivCodePostal): self
    {
        $this->adrLivCodePostal = $adrLivCodePostal;

        return $this;
    }

    public function getAdrLivVille(): ?string
    {
        return $this->adrLivVille;
    }

    public function setAdrLivVille(?string $adrLivVille): self
    {
        $this->adrLivVille = $adrLivVille;

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

    public function getTypeClient(): ?int
    {
        return $this->typeClient;
    }

    public function setTypeClient(int $typeClient): self
    {
        $this->typeClient = $typeClient;

        return $this;
    }

    public function getEngagement(): ?string
    {
        return $this->engagement;
    }

    public function setEngagement(?string $engagement): self
    {
        $this->engagement = $engagement;

        return $this;
    }

    public function getCodeService(): ?string
    {
        return $this->codeService;
    }

    public function setCodeService(?string $codeService): self
    {
        $this->codeService = $codeService;

        return $this;
    }

    public function getAdrFacture(): ?string
    {
        return $this->adrFacture;
    }

    public function setAdrFacture(?string $adrFacture): self
    {
        $this->adrFacture = $adrFacture;

        return $this;
    }

    public function getAdrFacCodePostal(): ?string
    {
        return $this->adrFacCodePostal;
    }

    public function setAdrFacCodePostal(?string $adrFacCodePostal): self
    {
        $this->adrFacCodePostal = $adrFacCodePostal;

        return $this;
    }

    public function getAdrFacVille(): ?string
    {
        return $this->adrFacVille;
    }

    public function setAdrFacVille(?string $adrFacVille): self
    {
        $this->adrFacVille = $adrFacVille;

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

    public function getPhonePortable(): ?string
    {
        return $this->phonePortable;
    }

    public function setPhonePortable(?string $phonePortable): self
    {
        $this->phonePortable = $phonePortable;

        return $this;
    }

    public function getPhonePortableTel(): ?int
    {
        return $this->phonePortableTel;
    }

    public function setPhonePortableTel(?int $phonePortableTel): self
    {
        $this->phonePortableTel = $phonePortableTel;

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

    public function getEmailStandard(): ?string
    {
        return $this->emailStandard;
    }

    public function setEmailStandard(?string $emailStandard): self
    {
        $this->emailStandard = $emailStandard;

        return $this;
    }

    public function getAppelClient(): ?int
    {
        return $this->appelClient;
    }

    public function setAppelClient(?int $appelClient): self
    {
        $this->appelClient = $appelClient;

        return $this;
    }

    public function getAppelLundi(): ?int
    {
        return $this->appelLundi;
    }

    public function setAppelLundi(?int $appelLundi): self
    {
        $this->appelLundi = $appelLundi;

        return $this;
    }

    public function getHoraireLundi(): ?string
    {
        return $this->horaireLundi;
    }

    public function setHoraireLundi(?string $horaireLundi): self
    {
        $this->horaireLundi = $horaireLundi;

        return $this;
    }

    public function getAppelMardi(): ?int
    {
        return $this->appelMardi;
    }

    public function setAppelMardi(?int $appelMardi): self
    {
        $this->appelMardi = $appelMardi;

        return $this;
    }

    public function getHoraireMardi(): ?string
    {
        return $this->horaireMardi;
    }

    public function setHoraireMardi(?string $horaireMardi): self
    {
        $this->horaireMardi = $horaireMardi;

        return $this;
    }

    public function getAppelMercredi(): ?int
    {
        return $this->appelMercredi;
    }

    public function setAppelMercredi(?int $appelMercredi): self
    {
        $this->appelMercredi = $appelMercredi;

        return $this;
    }

    public function getHoraireMercredi(): ?string
    {
        return $this->horaireMercredi;
    }

    public function setHoraireMercredi(?string $horaireMercredi): self
    {
        $this->horaireMercredi = $horaireMercredi;

        return $this;
    }

    public function getAppelJeudi(): ?int
    {
        return $this->appelJeudi;
    }

    public function setAppelJeudi(?int $appelJeudi): self
    {
        $this->appelJeudi = $appelJeudi;

        return $this;
    }

    public function getHoraireJeudi(): ?string
    {
        return $this->horaireJeudi;
    }

    public function setHoraireJeudi(?string $horaireJeudi): self
    {
        $this->horaireJeudi = $horaireJeudi;

        return $this;
    }

    public function getAppelVendredi(): ?int
    {
        return $this->appelVendredi;
    }

    public function setAppelVendredi(?int $appelVendredi): self
    {
        $this->appelVendredi = $appelVendredi;

        return $this;
    }

    public function getHoraireVendredi(): ?string
    {
        return $this->horaireVendredi;
    }

    public function setHoraireVendredi(?string $horaireVendredi): self
    {
        $this->horaireVendredi = $horaireVendredi;

        return $this;
    }

    public function getAppelSamedi(): ?int
    {
        return $this->appelSamedi;
    }

    public function setAppelSamedi(?int $appelSamedi): self
    {
        $this->appelSamedi = $appelSamedi;

        return $this;
    }

    public function getHoraireSamedi(): ?string
    {
        return $this->horaireSamedi;
    }

    public function setHoraireSamedi(?string $horaireSamedi): self
    {
        $this->horaireSamedi = $horaireSamedi;

        return $this;
    }

    public function getEmailFacture(): ?string
    {
        return $this->emailFacture;
    }

    public function setEmailFacture(?string $emailFacture): self
    {
        $this->emailFacture = $emailFacture;

        return $this;
    }

    public function getTarifClient(): ?string
    {
        return $this->tarifClient;
    }

    public function setTarifClient(?string $tarifClient): self
    {
        $this->tarifClient = $tarifClient;

        return $this;
    }

    public function getEnvoiTarifAuto(): ?int
    {
        return $this->envoiTarifAuto;
    }

    public function setEnvoiTarifAuto(?int $envoiTarifAuto): self
    {
        $this->envoiTarifAuto = $envoiTarifAuto;

        return $this;
    }

    public function getDate1Livraison(): ?\DateTimeInterface
    {
        return $this->date1Livraison;
    }

    public function setDate1Livraison(?\DateTimeInterface $date1Livraison): self
    {
        $this->date1Livraison = $date1Livraison;

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

    public function getAvance(): ?int
    {
        return $this->avance;
    }

    public function setAvance(int $avance): self
    {
        $this->avance = $avance;

        return $this;
    }

    public function getCheque(): ?int
    {
        return $this->cheque;
    }

    public function setCheque(?int $cheque): self
    {
        $this->cheque = $cheque;

        return $this;
    }

    public function getVirement(): ?int
    {
        return $this->virement;
    }

    public function setVirement(?int $virement): self
    {
        $this->virement = $virement;

        return $this;
    }

    public function getPrelevement(): ?int
    {
        return $this->prelevement;
    }

    public function setPrelevement(?int $prelevement): self
    {
        $this->prelevement = $prelevement;

        return $this;
    }

    public function getExtKbis(): ?string
    {
        return $this->ext_kbis;
    }

    public function setExtKbis(?string $ext_kbis): self
    {
        $this->ext_kbis = $ext_kbis;

        return $this;
    }

    public function getExtCgv(): ?string
    {
        return $this->ext_cgv;
    }

    public function setExtCgv(?string $ext_cgv): self
    {
        $this->ext_cgv = $ext_cgv;

        return $this;
    }

    public function getExtAuth(): ?string
    {
        return $this->ext_auth;
    }

    public function setExtAuth(?string $ext_auth): self
    {
        $this->ext_auth = $ext_auth;

        return $this;
    }

    public function getExtRib(): ?string
    {
        return $this->ext_rib;
    }

    public function setExtRib(?string $ext_rib): self
    {
        $this->ext_rib = $ext_rib;

        return $this;
    }

    public function getExtAutres(): ?string
    {
        return $this->ext_autres;
    }

    public function setExtAutres(?string $ext_autres): self
    {
        $this->ext_autres = $ext_autres;

        return $this;
    }

    public function getCtDirNom(): ?string
    {
        return $this->ctDirNom;
    }

    public function setCtDirNom(?string $ctDirNom): self
    {
        $this->ctDirNom = $ctDirNom;

        return $this;
    }

    public function getCtDirTel(): ?string
    {
        return $this->ctDirTel;
    }

    public function setCtDirTel(?string $ctDirTel): self
    {
        $this->ctDirTel = $ctDirTel;

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

    public function getCtComptaNom(): ?string
    {
        return $this->ctComptaNom;
    }

    public function setCtComptaNom(?string $ctComptaNom): self
    {
        $this->ctComptaNom = $ctComptaNom;

        return $this;
    }

    public function getCtComptaTel(): ?string
    {
        return $this->ctComptaTel;
    }

    public function setCtComptaTel(?string $ctComptaTel): self
    {
        $this->ctComptaTel = $ctComptaTel;

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

    public function getCtComNom(): ?string
    {
        return $this->ctComNom;
    }

    public function setCtComNom(?string $ctComNom): self
    {
        $this->ctComNom = $ctComNom;

        return $this;
    }

    public function getCtComTel(): ?string
    {
        return $this->ctComTel;
    }

    public function setCtComTel(?string $ctComTel): self
    {
        $this->ctComTel = $ctComTel;

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

    public function getCtQuaNom(): ?string
    {
        return $this->ctQuaNom;
    }

    public function setCtQuaNom(?string $ctQuaNom): self
    {
        $this->ctQuaNom = $ctQuaNom;

        return $this;
    }

    public function getCtQuaTel(): ?string
    {
        return $this->ctQuaTel;
    }

    public function setCtQuaTel(?string $ctQuaTel): self
    {
        $this->ctQuaTel = $ctQuaTel;

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

    public function getCtSecNom(): ?string
    {
        return $this->ctSecNom;
    }

    public function setCtSecNom(?string $ctSecNom): self
    {
        $this->ctSecNom = $ctSecNom;

        return $this;
    }

    public function getCtSecTel(): ?string
    {
        return $this->ctSecTel;
    }

    public function setCtSecTel(?string $ctSecTel): self
    {
        $this->ctSecTel = $ctSecTel;

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

    public function getTrLundi(): ?string
    {
        return $this->trLundi;
    }

    public function setTrLundi(?string $trLundi): self
    {
        $this->trLundi = $trLundi;

        return $this;
    }

    public function getTrMardi(): ?string
    {
        return $this->trMardi;
    }

    public function setTrMardi(?string $trMardi): self
    {
        $this->trMardi = $trMardi;

        return $this;
    }

    public function getTrMercredi(): ?string
    {
        return $this->trMercredi;
    }

    public function setTrMercredi(?string $trMercredi): self
    {
        $this->trMercredi = $trMercredi;

        return $this;
    }

    public function getTrJeudi(): ?string
    {
        return $this->trJeudi;
    }

    public function setTrJeudi(?string $trJeudi): self
    {
        $this->trJeudi = $trJeudi;

        return $this;
    }

    public function getTrVendredi(): ?string
    {
        return $this->trVendredi;
    }

    public function setTrVendredi(?string $trVendredi): self
    {
        $this->trVendredi = $trVendredi;

        return $this;
    }

    public function getTrSamedi(): ?string
    {
        return $this->trSamedi;
    }

    public function setTrSamedi(?string $trSamedi): self
    {
        $this->trSamedi = $trSamedi;

        return $this;
    }

    public function getRgLundi(): ?string
    {
        return $this->rgLundi;
    }

    public function setRgLundi(?string $rgLundi): self
    {
        $this->rgLundi = $rgLundi;

        return $this;
    }

    public function getRgMardi(): ?string
    {
        return $this->rgMardi;
    }

    public function setRgMardi(?string $rgMardi): self
    {
        $this->rgMardi = $rgMardi;

        return $this;
    }

    public function getRgMercredi(): ?string
    {
        return $this->rgMercredi;
    }

    public function setRgMercredi(?string $rgMercredi): self
    {
        $this->rgMercredi = $rgMercredi;

        return $this;
    }

    public function getRgJeudi(): ?string
    {
        return $this->rgJeudi;
    }

    public function setRgJeudi(?string $rgJeudi): self
    {
        $this->rgJeudi = $rgJeudi;

        return $this;
    }

    public function getRgVendredi(): ?string
    {
        return $this->rgVendredi;
    }

    public function setRgVendredi(?string $rgVendredi): self
    {
        $this->rgVendredi = $rgVendredi;

        return $this;
    }

    public function getRgSamedi(): ?string
    {
        return $this->rgSamedi;
    }

    public function setRgSamedi(?string $rgSamedi): self
    {
        $this->rgSamedi = $rgSamedi;

        return $this;
    }

    public function getPlageHoraire(): ?string
    {
        return $this->plageHoraire;
    }

    public function setPlageHoraire(?string $plageHoraire): self
    {
        $this->plageHoraire = $plageHoraire;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getBp(): ?string
    {
        return $this->bp;
    }

    public function setBp(?string $bp): self
    {
        $this->bp = $bp;

        return $this;
    }

    public function getBl(): ?string
    {
        return $this->bl;
    }

    public function setBl(?string $bl): self
    {
        $this->bl = $bl;

        return $this;
    }

    public function getDirCom(): ?string
    {
        return $this->dirCom;
    }

    public function setDirCom(?string $dirCom): self
    {
        $this->dirCom = $dirCom;

        return $this;
    }

    public function getComMaitre(): ?string
    {
        return $this->comMaitre;
    }

    public function setComMaitre(?string $comMaitre): self
    {
        $this->comMaitre = $comMaitre;

        return $this;
    }

    public function getCom(): ?string
    {
        return $this->com;
    }

    public function setCom(?string $com): self
    {
        $this->com = $com;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(?string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getTaux1(): ?string
    {
        return $this->taux1;
    }

    public function setTaux1(?string $taux1): self
    {
        $this->taux1 = $taux1;

        return $this;
    }

    public function getTaux2(): ?string
    {
        return $this->taux2;
    }

    public function setTaux2(string $taux2): self
    {
        $this->taux2 = $taux2;

        return $this;
    }

    public function getTaux3(): ?string
    {
        return $this->taux3;
    }

    public function setTaux3(?string $taux3): self
    {
        $this->taux3 = $taux3;

        return $this;
    }

    public function getNature1(): ?string
    {
        return $this->nature1;
    }

    public function setNature1(?string $nature1): self
    {
        $this->nature1 = $nature1;

        return $this;
    }

    public function getNature2(): ?string
    {
        return $this->nature2;
    }

    public function setNature2(?string $nature2): self
    {
        $this->nature2 = $nature2;

        return $this;
    }

    public function getNature3(): ?string
    {
        return $this->nature3;
    }

    public function setNature3(?string $nature3): self
    {
        $this->nature3 = $nature3;

        return $this;
    }

    public function getLimiteFrais(): ?string
    {
        return $this->limiteFrais;
    }

    public function setLimiteFrais(?string $limiteFrais): self
    {
        $this->limiteFrais = $limiteFrais;

        return $this;
    }

    public function getMontantFrais(): ?string
    {
        return $this->montantFrais;
    }

    public function setMontantFrais(string $montantFrais): self
    {
        $this->montantFrais = $montantFrais;

        return $this;
    }

    public function getFraisDev(): ?int
    {
        return $this->fraisDev;
    }

    public function setFraisDev(int $fraisDev): self
    {
        $this->fraisDev = $fraisDev;

        return $this;
    }

    public function getDelaisReg(): ?string
    {
        return $this->delaisReg;
    }

    public function setDelaisReg(?string $delaisReg): self
    {
        $this->delaisReg = $delaisReg;

        return $this;
    }

    public function getBlocCompte(): ?int
    {
        return $this->blocCompte;
    }

    public function setBlocCompte(?int $blocCompte): self
    {
        $this->blocCompte = $blocCompte;

        return $this;
    }

    public function getCompanyTransport(): ?string
    {
        return $this->companyTransport;
    }

    public function setCompanyTransport(?string $companyTransport): self
    {
        $this->companyTransport = $companyTransport;

        return $this;
    }

    public function getDateValidDirection(): ?\DateTimeInterface
    {
        return $this->dateValidDirection;
    }

    public function setDateValidDirection(?\DateTimeInterface $dateValidDirection): self
    {
        $this->dateValidDirection = $dateValidDirection;

        return $this;
    }

    public function getRaisonRefus(): ?string
    {
        return $this->raisonRefus;
    }

    public function setRaisonRefus(?string $raisonRefus): self
    {
        $this->raisonRefus = $raisonRefus;

        return $this;
    }

    public function getDateReceptionDirecteur(): ?\DateTimeInterface
    {
        return $this->dateReceptionDirecteur;
    }

    public function setDateReceptionDirecteur(?\DateTimeInterface $dateReceptionDirecteur): self
    {
        $this->dateReceptionDirecteur = $dateReceptionDirecteur;

        return $this;
    }

    public function getDateReceptionLogistique(): ?\DateTimeInterface
    {
        return $this->dateReceptionLogistique;
    }

    public function setDateReceptionLogistique(?\DateTimeInterface $dateReceptionLogistique): self
    {
        $this->dateReceptionLogistique = $dateReceptionLogistique;

        return $this;
    }
}
