<?php

namespace App\Entity;

use App\Repository\FicheArticleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FicheArticleRepository::class)
 */
class FicheArticle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etapeFiche", type="string", length=50, nullable=true)
     */
    private $etapefiche;

    /**
     * @var string|null
     *
     * @ORM\Column(name="societe", type="string", length=50, nullable=true)
     */
    private $societe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codeFiche", type="string", length=10, nullable=true)
     */
    private $codefiche;

    /**
     * @var string|null
     *
     * @ORM\Column(name="utilisateur", type="string", length=50, nullable=true)
     */
    private $utilisateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="generique", type="string", length=50, nullable=true)
     */
    private $generique;

    /**
     * @var string|null
     *
     * @ORM\Column(name="esp_var", type="string", length=100, nullable=true)
     */
    private $espVar;

    /**
     * @var string|null
     *
     * @ORM\Column(name="marque", type="string", length=100, nullable=true)
     */
    private $marque;

    /**
     * @var string|null
     *
     * @ORM\Column(name="origine", type="string", length=100, nullable=true)
     */
    private $origine;

    /**
     * @var string|null
     *
     * @ORM\Column(name="calibre", type="string", length=100, nullable=true)
     */
    private $calibre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="conditionnement", type="string", length=100, nullable=true)
     */
    private $conditionnement;

    /**
     * @var string|null
     *
     * @ORM\Column(name="categorie", type="string", length=100, nullable=true)
     */
    private $categorie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="semmaris", type="string", length=100, nullable=true)
     */
    private $semmaris;

    /**
     * @var string|null
     *
     * @ORM\Column(name="grp_article", type="string", length=100, nullable=true)
     */
    private $grpArticle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ma_nom_latin", type="string", length=100, nullable=true)
     */
    private $maNomLatin;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ma_zone_peche", type="string", length=100, nullable=true)
     */
    private $maZonePeche;

    /**
     * @var string|null
     *
     * @ORM\Column(name="kg_col", type="string", length=20, nullable=true)
     */
    private $kgCol;

    /**
     * @var int|null
     *
     * @ORM\Column(name="kg_col_on", type="integer", nullable=true)
     */
    private $kgColOn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="p_col", type="string", length=20, nullable=true)
     */
    private $pCol;

    /**
     * @var int|null
     *
     * @ORM\Column(name="p_col_on", type="integer", nullable=true)
     */
    private $pColOn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stat1", type="string", length=250, nullable=true)
     */
    private $stat1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stat2", type="string", length=250, nullable=true)
     */
    private $stat2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stat3", type="string", length=250, nullable=true)
     */
    private $stat3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stat4", type="string", length=250, nullable=true)
     */
    private $stat4;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dlc_on", type="integer", nullable=true)
     */
    private $dlcOn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dlc_jour", type="string", length=50, nullable=true)
     */
    private $dlcJour;

    /**
     * @var string|null
     *
     * @ORM\Column(name="unite_achat", type="string", length=20, nullable=true)
     */
    private $uniteAchat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="unite_vente", type="string", length=20, nullable=true)
     */
    private $uniteVente;

    /**
     * @var string|null
     *
     * @ORM\Column(name="unite_stock", type="string", length=20, nullable=true)
     */
    private $uniteStock;

    /**
     * @var string|null
     *
     * @ORM\Column(name="men_val", type="string", length=250, nullable=true)
     */
    private $menVal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="localisation", type="string", length=250, nullable=true)
     */
    private $localisation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rup", type="string", length=250, nullable=true)
     */
    private $rup;

    /**
     * @var string|null
     *
     * @ORM\Column(name="siqo", type="string", length=250, nullable=true)
     */
    private $siqo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_article", type="string", length=50, nullable=true)
     */
    private $codeArticle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_sodexo", type="string", length=50, nullable=true)
     */
    private $codeSodexo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_sxo", type="string", length=50, nullable=true)
     */
    private $codeSxo;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fait_le", type="date", nullable=true)
     */
    private $faitLe;

    /**
     * @ORM\ManyToOne(targetEntity=Companies::class, inversedBy="ficheArticles")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ficheArticles")
     */
    private $username;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtapefiche(): ?string
    {
        return $this->etapefiche;
    }

    public function setEtapefiche(?string $etapefiche): self
    {
        $this->etapefiche = $etapefiche;

        return $this;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(?string $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getCodefiche(): ?string
    {
        return $this->codefiche;
    }

    public function setCodefiche(?string $codefiche): self
    {
        $this->codefiche = $codefiche;

        return $this;
    }

    public function getUtilisateur(): ?string
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?string $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getGenerique(): ?string
    {
        return $this->generique;
    }

    public function setGenerique(?string $generique): self
    {
        $this->generique = $generique;

        return $this;
    }

    public function getEspVar(): ?string
    {
        return $this->espVar;
    }

    public function setEspVar(?string $espVar): self
    {
        $this->espVar = $espVar;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->origine;
    }

    public function setOrigine(?string $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getCalibre(): ?string
    {
        return $this->calibre;
    }

    public function setCalibre(?string $calibre): self
    {
        $this->calibre = $calibre;

        return $this;
    }

    public function getConditionnement(): ?string
    {
        return $this->conditionnement;
    }

    public function setConditionnement(?string $conditionnement): self
    {
        $this->conditionnement = $conditionnement;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getSemmaris(): ?string
    {
        return $this->semmaris;
    }

    public function setSemmaris(?string $semmaris): self
    {
        $this->semmaris = $semmaris;

        return $this;
    }

    public function getGrpArticle(): ?string
    {
        return $this->grpArticle;
    }

    public function setGrpArticle(?string $grpArticle): self
    {
        $this->grpArticle = $grpArticle;

        return $this;
    }

    public function getMaNomLatin(): ?string
    {
        return $this->maNomLatin;
    }

    public function setMaNomLatin(?string $maNomLatin): self
    {
        $this->maNomLatin = $maNomLatin;

        return $this;
    }

    public function getMaZonePeche(): ?string
    {
        return $this->maZonePeche;
    }

    public function setMaZonePeche(?string $maZonePeche): self
    {
        $this->maZonePeche = $maZonePeche;

        return $this;
    }

    public function getKgCol(): ?string
    {
        return $this->kgCol;
    }

    public function setKgCol(?string $kgCol): self
    {
        $this->kgCol = $kgCol;

        return $this;
    }

    public function getKgColOn(): ?int
    {
        return $this->kgColOn;
    }

    public function setKgColOn(?int $kgColOn): self
    {
        $this->kgColOn = $kgColOn;

        return $this;
    }

    public function getPCol(): ?string
    {
        return $this->pCol;
    }

    public function setPCol(?string $pCol): self
    {
        $this->pCol = $pCol;

        return $this;
    }

    public function getPColOn(): ?int
    {
        return $this->pColOn;
    }

    public function setPColOn(?int $pColOn): self
    {
        $this->pColOn = $pColOn;

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

    public function getDlcOn(): ?int
    {
        return $this->dlcOn;
    }

    public function setDlcOn(?int $dlcOn): self
    {
        $this->dlcOn = $dlcOn;

        return $this;
    }

    public function getDlcJour(): ?string
    {
        return $this->dlcJour;
    }

    public function setDlcJour(?string $dlcJour): self
    {
        $this->dlcJour = $dlcJour;

        return $this;
    }

    public function getUniteAchat(): ?string
    {
        return $this->uniteAchat;
    }

    public function setUniteAchat(?string $uniteAchat): self
    {
        $this->uniteAchat = $uniteAchat;

        return $this;
    }

    public function getUniteVente(): ?string
    {
        return $this->uniteVente;
    }

    public function setUniteVente(?string $uniteVente): self
    {
        $this->uniteVente = $uniteVente;

        return $this;
    }

    public function getUniteStock(): ?string
    {
        return $this->uniteStock;
    }

    public function setUniteStock(?string $uniteStock): self
    {
        $this->uniteStock = $uniteStock;

        return $this;
    }

    public function getMenVal(): ?string
    {
        return $this->menVal;
    }

    public function setMenVal(?string $menVal): self
    {
        $this->menVal = $menVal;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(?string $localisation): self
    {
        $this->localisation = $localisation;

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

    public function setSiqo(?string $siqo): self
    {
        $this->siqo = $siqo;

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

    public function getCodeSxo(): ?string
    {
        return $this->codeSxo;
    }

    public function setCodeSxo(?string $codeSxo): self
    {
        $this->codeSxo = $codeSxo;

        return $this;
    }

    public function getFaitLe(): ?\DateTimeInterface
    {
        return $this->faitLe;
    }

    public function setFaitLe(?\DateTimeInterface $faitLe): self
    {
        $this->faitLe = $faitLe;

        return $this;
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


}
