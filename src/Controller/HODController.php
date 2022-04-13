<?php

namespace App\Controller;

use App\Controller\SQL\SQLController;
use App\Entity\Companies;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use function PHPUnit\Framework\isEmpty;

class HODController extends AbstractController
{
    /**
     * @Route("/Stats_HubOne", name="hodAPI")
     */
    public function hodAPI(UserInterface $user)
    {
        if(isset($_GET["dateStart"]))
        {
            $sql = new SQLController;

            $dateStart = date('d-m-Y', strtotime($_GET["dateStart"]));
            $dateEnd = date('d-m-Y', strtotime($_GET["dateEnd"]));
            
            $codeClient = "";
            $nomAppel = "";
            $cp = "";
            $ville = "";

            if($_GET["codeClient"] != "")
            {
                $codeClient = "pdp.identifiant_pdp LIKE '%".$_GET["codeClient"]."%' AND ";
            }
            if($_GET["nomAppel"] != "")
            {
                $nomAppel = "pdp.nomContact LIKE '%".$_GET["nomAppel"]."%' AND ";
            }
            if($_GET["cp"] != "")
            {
                $ville = "adr.codePostal = '".$_GET["cp"]."' AND ";
            }
            if($_GET["ville"] != "")
            {
                $ville = "adr.ville LIKE '%".$_GET["ville"]."%' AND ";
            }

            $i = 0;
            $clients = array();

            $req = $sql->requete("SELECT SUBSTRING(tr.libelle, 1, (LEN(tr.libelle)-9)) AS 'Tournee', tr.date AS 'Date', tr.identifiantSite AS 'Societe Depart', SUBSTRING(pdp.identifiant_pdp, 0, CHARINDEX('-', pdp.identifiant_pdp)) AS 'Societe Commande',
            SUBSTRING(identifiant_pdp, CHARINDEX('-', identifiant_pdp, CHARINDEX('-', identifiant_pdp, 0) + 6) + 5, 20) AS 'N° Commande',
            UPPER(SUBSTRING(pdp.identifiant_pdp, CHARINDEX('-', pdp.identifiant_pdp) + 6, CHARINDEX('-', SUBSTRING(pdp.identifiant_pdp, CHARINDEX('-', pdp.identifiant_pdp) + 6, 20), 0) - 1)) AS 'Code Client',
            pdp.nomContact AS 'Libelle Client', adr.adresse1 AS 'Adresse 1', adr.adresse2 AS 'Adresse 2', adr.adresse3 AS 'Adresse 3', adr.codePostal AS 'Code Postal', adr.ville AS 'Ville', vvy.codeRibeGroupe AS 'Grand Compte Vivalya', tr.nomChauffeur + ' ' + tr.prenomChauffeur AS 'Nom /Prenom Chauffeur', tr.identifiantVehicule AS 'Immatriculation', FORMAT(tr.heureDebut, '%H:%m:%s') + ' - ' + FORMAT(tr.heureFin, '%H:%m:%s') AS 'Horaire Tournee D/F',
            FORMAT(pdp.dateHeureArriveePrevueInitialement, '%H:%m:%s') + ' - ' + FORMAT(pdp.dateHeureDepartPrevueInitialement, '%H:%m:%s') AS 'Horaire Livraison Prevu',
            FORMAT(pdp.dateHeureArriveeRealisee, '%H:%m:%s') AS 'Horaire Livraison Realise', pdp.isOK AS 'Respect Horaire', COUNT(c_ano.id_pdp) AS 'NB Anomalise Livraison',
            loc.latitude AS 'Latitude', loc.longitude AS 'Longitude', loc.ecartPrevuReel AS 'Ecart Reel (KM)'
            FROM PointPassages AS pdp
            LEFT JOIN PDP_Adresses AS adr ON adr.id_pdp = pdp.identifiant_pdp
            LEFT JOIN Colis_Anomalies AS c_ano ON c_ano.id_pdp = pdp.identifiant_pdp
            LEFT JOIN Tournees AS tr ON tr.identifiant = pdp.id_tournee
            LEFT JOIN PDP_LocalisationPreuveLivraison AS loc ON loc.id_pdp = pdp.identifiant_pdp
            LEFT JOIN PDPGrandCompteVVY AS vvy ON vvy.codeVivalya = pdp.prenomContact
            WHERE ".$codeClient.$nomAppel.$cp.$ville." SUBSTRING(tr.identifiant, 0, CHARINDEX('-', tr.identifiant)) NOT IN('ARD', 'ENTA', 'RAMA', 'RIV', 'ENT', 'ENTR', 'FARR', 'PRI', 'RAM', 'RP', 'TFER', 'DEPR', 'FREV', 'RAMD', 'RDEP', 'ROD', 'YYY', 'DEP', 'RAMV', 'VEL') AND tr.date BETWEEN '".$dateStart."' AND '".$dateEnd."' AND(tr.identifiantSite != 'PROMER' AND tr.identifiantSite != 'DIFFOR') AND SUBSTRING(identifiant_pdp, CHARINDEX('-', identifiant_pdp, CHARINDEX('-', identifiant_pdp, 0) + 6)+1, 3) != 'RAM'
            GROUP BY SUBSTRING(tr.libelle, 1, (LEN(tr.libelle) - 9)), tr.date, tr.identifiantSite, SUBSTRING(pdp.identifiant_pdp, 0, CHARINDEX('-', pdp.identifiant_pdp)),
            SUBSTRING(identifiant_pdp, CHARINDEX('-', identifiant_pdp, CHARINDEX('-', identifiant_pdp, 0) + 6) + 5, 20), UPPER(SUBSTRING(pdp.identifiant_pdp, CHARINDEX('-', pdp.identifiant_pdp) + 6, CHARINDEX('-', SUBSTRING(pdp.identifiant_pdp, CHARINDEX('-', pdp.identifiant_pdp) + 6, 20), 0) - 1)),
            pdp.nomContact, adr.adresse1, adr.adresse2, adr.adresse3, adr.codePostal, adr.ville, vvy.codeRibeGroupe, tr.nomChauffeur + ' ' + tr.prenomChauffeur, tr.identifiantVehicule, FORMAT(tr.heureDebut, '%H:%m:%s') + ' - ' + FORMAT(tr.heureFin, '%H:%m:%s'),
            FORMAT(pdp.dateHeureArriveePrevueInitialement, '%H:%m:%s') + ' - ' + FORMAT(pdp.dateHeureDepartPrevueInitialement, '%H:%m:%s'), FORMAT(pdp.dateHeureArriveeRealisee, '%H:%m:%s'),
            pdp.isOK, loc.latitude, loc.longitude, loc.ecartPrevuReel
            ORDER BY SUBSTRING(tr.libelle, 1, (LEN(tr.libelle) - 9)), FORMAT(pdp.dateHeureArriveeRealisee, '%H:%m:%s') ASC", "HOD_API");
            while ($r = $req->fetch())
            {
                $clients[$i] = $r;
                $i++;
            }

            return $this->render('HOD/stats_hod.html.twig', ["clients" => $clients, "dateStart" => $dateStart, "dateEnd" => $dateEnd]);
        }

        $allCompanies = $this->getDoctrine()->getRepository(Companies::class);
        $companies = $allCompanies->findAll();

        return $this->render('HOD/form_stats_hod.html.twig', ["companies" => $companies]);
    }
}
