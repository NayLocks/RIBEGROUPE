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
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Companies::class, inversedBy="ficheArticles")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ficheArticles")
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
    private $generique;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $espVar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $origine;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $calibre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $conditionnement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $grpArticle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomLatin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $zonePeche;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poidsColis;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $poidsColisVariable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pieceColis;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $pieceColisVariable;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dlc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dlcJour;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $uniteAchat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $uniteVente;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $uniteStock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $menVal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $localisation;

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
    private $codeArticle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeSodexo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeSXO;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

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

    public function getGenerique(): ?string
    {
        return $this->generique;
    }

    public function setGenerique(string $generique): self
    {
        $this->generique = $generique;

        return $this;
    }

    public function getEspVar(): ?string
    {
        return $this->espVar;
    }

    public function setEspVar(string $espVar): self
    {
        $this->espVar = $espVar;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getOrigine(): ?string
    {
        return $this->origine;
    }

    public function setOrigine(string $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getCalibre(): ?string
    {
        return $this->calibre;
    }

    public function setCalibre(string $calibre): self
    {
        $this->calibre = $calibre;

        return $this;
    }

    public function getConditionnement(): ?string
    {
        return $this->conditionnement;
    }

    public function setConditionnement(string $conditionnement): self
    {
        $this->conditionnement = $conditionnement;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getGrpArticle(): ?string
    {
        return $this->grpArticle;
    }

    public function setGrpArticle(string $grpArticle): self
    {
        $this->grpArticle = $grpArticle;

        return $this;
    }

    public function getNomLatin(): ?string
    {
        return $this->nomLatin;
    }

    public function setNomLatin(string $nomLatin): self
    {
        $this->nomLatin = $nomLatin;

        return $this;
    }

    public function getZonePeche(): ?string
    {
        return $this->zonePeche;
    }

    public function setZonePeche(string $zonePeche): self
    {
        $this->zonePeche = $zonePeche;

        return $this;
    }

    public function getPoidsColis(): ?string
    {
        return $this->poidsColis;
    }

    public function setPoidsColis(string $poidsColis): self
    {
        $this->poidsColis = $poidsColis;

        return $this;
    }

    public function getPoidsColisVariable(): ?int
    {
        return $this->poidsColisVariable;
    }

    public function setPoidsColisVariable(int $poidsColisVariable): self
    {
        $this->poidsColisVariable = $poidsColisVariable;

        return $this;
    }

    public function getPieceColis(): ?string
    {
        return $this->pieceColis;
    }

    public function setPieceColis(string $pieceColis): self
    {
        $this->pieceColis = $pieceColis;

        return $this;
    }

    public function getPieceColisVariable(): ?int
    {
        return $this->pieceColisVariable;
    }

    public function setPieceColisVariable(int $pieceColisVariable): self
    {
        $this->pieceColisVariable = $pieceColisVariable;

        return $this;
    }

    public function getStat1(): ?string
    {
        return $this->stat1;
    }

    public function setStat1(string $stat1): self
    {
        $this->stat1 = $stat1;

        return $this;
    }

    public function getStat2(): ?string
    {
        return $this->stat2;
    }

    public function setStat2(string $stat2): self
    {
        $this->stat2 = $stat2;

        return $this;
    }

    public function getStat3(): ?string
    {
        return $this->stat3;
    }

    public function setStat3(string $stat3): self
    {
        $this->stat3 = $stat3;

        return $this;
    }

    public function getStat4(): ?string
    {
        return $this->stat4;
    }

    public function setStat4(string $stat4): self
    {
        $this->stat4 = $stat4;

        return $this;
    }

    public function getDlc(): ?int
    {
        return $this->dlc;
    }

    public function setDlc(int $dlc): self
    {
        $this->dlc = $dlc;

        return $this;
    }

    public function getDlcJour(): ?string
    {
        return $this->dlcJour;
    }

    public function setDlcJour(string $dlcJour): self
    {
        $this->dlcJour = $dlcJour;

        return $this;
    }

    public function getUniteAchat(): ?string
    {
        return $this->uniteAchat;
    }

    public function setUniteAchat(string $uniteAchat): self
    {
        $this->uniteAchat = $uniteAchat;

        return $this;
    }

    public function getUniteVente(): ?string
    {
        return $this->uniteVente;
    }

    public function setUniteVente(string $uniteVente): self
    {
        $this->uniteVente = $uniteVente;

        return $this;
    }

    public function getUniteStock(): ?string
    {
        return $this->uniteStock;
    }

    public function setUniteStock(string $uniteStock): self
    {
        $this->uniteStock = $uniteStock;

        return $this;
    }

    public function getMenVal(): ?string
    {
        return $this->menVal;
    }

    public function setMenVal(string $menVal): self
    {
        $this->menVal = $menVal;

        return $this;
    }

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

    public function getRup(): ?string
    {
        return $this->rup;
    }

    public function setRup(string $rup): self
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

    public function getCodeArticle(): ?string
    {
        return $this->codeArticle;
    }

    public function setCodeArticle(string $codeArticle): self
    {
        $this->codeArticle = $codeArticle;

        return $this;
    }

    public function getCodeSodexo(): ?string
    {
        return $this->codeSodexo;
    }

    public function setCodeSodexo(string $codeSodexo): self
    {
        $this->codeSodexo = $codeSodexo;

        return $this;
    }

    public function getCodeSXO(): ?string
    {
        return $this->codeSXO;
    }

    public function setCodeSXO(string $codeSXO): self
    {
        $this->codeSXO = $codeSXO;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }
}
