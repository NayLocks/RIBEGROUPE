<?php

namespace App\Controller;

use App\Controller\SQL\SQLController;
use App\Entity\Companies;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use function PHPUnit\Framework\isEmpty;

class TauxEBLByClientController extends AbstractController //MANQUE LE REDIRECTI ROUTE POUR AFFICHER LA LISTE DESS CLIENT./
{
    /**
     * @Route("/Taux_Egalim_Bio_Local", name="tauxDate")
     */
    public function date(UserInterface $user)
    {
        if(isset($_POST["dateStart"]))
        {
            $sql = new SQLController;

            $dateStart = date('d-m-Y', strtotime($_POST["dateStart"]));
            $dateEnd = date('d-m-Y', strtotime($_POST["dateEnd"]));
            
            $codeClient = "";
            $nomAppel = "";
            $cp = "";
            $ville = "";

            if($_POST["codeClient"] != "")
            {
                $codeClient = "FA.FtgNr LIKE '".$_POST["codeClient"]."' AND ";
            }
            if($_POST["nomAppel"] != "")
            {
                $nomAppel = "FA.FtgNamn LIKE '%".$_POST["nomAppel"]."%' AND ";
            }
            if($_POST["cp"] != "")
            {
                $cp = "FA.FtgPostnr = '".$_POST["cp"]."' AND ";
            }
            if($_POST["ville"] != "")
            {
                $ville = "FA.FtgPostAdr3 LIKE '%".$_POST["ville"]."%' AND ";
            }

            $i = 0;
            $clients = array();

            $req = $sql->requete("SELECT FA.FtgNr AS 'Code_Client', FA.FtgNamn AS 'Libelle_Client', FA.FtgPostAdr1 AS 'Adresse', FA.FtgPostnr AS 'Code_Postal', FA.FtgPostAdr3 AS 'Ville' FROM q_2bv_facture AS FA WITH (NOLOCK)
            WHERE ".$codeClient.$nomAppel.$cp.$ville."(FA.FaktDat BETWEEN '".$dateStart."' AND '".$dateEnd."') GROUP BY FA.FtgNr, FA.FtgNamn, FA.FtgPostAdr1, FA.FtgPostnr, FA.FtgPostAdr3 ORDER BY FA.FtgNamn ASC", $_POST["company"]);
            while ($r = $req->fetch())
            {
                $clients[$i] = $r;
                $i++;
            }

            return $this->render('TauxEBL/clients.html.twig', ["clients" => $clients, "dateStart" => $dateStart, "dateEnd" => $dateEnd, "company" => $_POST["company"]]);
        }

        $allCompanies = $this->getDoctrine()->getRepository(Companies::class);
        $companies = $allCompanies->findAll();

        return $this->render('TauxEBL/date.html.twig', ["companies" => $companies]);
    }
    
    /**
     * @Route("/Taux_Egalim_Bio_Local/{ftgnr}/{dateStart}/{dateEnd}/{company}", name="tauxEBL")
     */
    public function tauxEBL(UserInterface $user, $ftgnr, $dateStart, $dateEnd, $company)
    {
        $sql = new SQLController();
    
        $i = 0;
        $articles = array();
        
        $mt_egalim = 0;
        $mt_bio = 0;
        $mt_local = 0;
        $tx_egalim = 0;
        $tx_bio = 0;
        $tx_local = 0;
        $total = 0;

        $tt_egalim = 0;
        $tt_bio = 0;
        $tt_local = 0;
        $tt_poids = 0;

        

        $req = $sql->requete("SELECT FA.FtgNr, FA.FtgNamn AS 'Libelle_Client', FA.FtgPostnr AS 'Code_Postal', FA.FtgPostAdr3 AS 'VILLE', AR.q_gcar_lib1 AS 'Libelle_Article', FA.q_is_EGALIM AS 'EGALIM', AR.q_gcar_stat4 AS 'BIO', AR.q_ar_statssurlocal AS 'LOCAL', ROUND(SUM(FA.q_gcbp_ua9), 2) AS 'Poids', ROUND(SUM((FA.vb_FaktRadSumma_Brutto-FA.FaktRadRabSumma)), 2) AS 'Prix_HT' FROM q_2bv_facture AS FA WITH (NOLOCK)
        LEFT JOIN ar AS AR ON AR.ArtNr = FA.ArtNr
        WHERE FA.FtgNr = '".$ftgnr."' AND (FA.FaktDat BETWEEN '".str_replace("-", "/", $dateStart)."' AND '".str_replace("-", "/", $dateEnd)."')
        GROUP BY FA.FtgNr, FA.FtgNamn, FA.FtgPostnr, FA.FtgPostAdr3, AR.q_gcar_lib1, FA.q_is_EGALIM, AR.q_gcar_stat4, AR.q_ar_statssurlocal
        ORDER BY AR.q_gcar_lib1 ASC", $company);

        while ($r = $req->fetch())
        {
            $articles[$i] = $r;
            $total = $total + $r[9];
            $tt_poids = $tt_poids + $r[8];
            $i++;

            if($r[5] == 1){
                $tx_egalim++;
                $mt_egalim = $mt_egalim +  $r[9];
                $tt_egalim++;
            }
            if($r[6] == 191){
                $tx_bio++;
                $mt_bio = $mt_bio +  $r[9];
                $tt_bio++;
            }
            if($r[7] == 10){
                $tx_local++;
                $mt_local = $mt_local +  $r[9];
                $tt_local++;
            }
        }

        if($total != 0){
            $tx_egalim = ($mt_egalim*100)/$total;
            $tx_bio = ($mt_bio*100)/$total;
            $tx_local = ($mt_local*100)/$total;
        }

        return $this->render('TauxEBL/taux.html.twig', ["articles" => $articles, "ftgnr" => $ftgnr, "dateStart" => str_replace("-", "/", $dateStart), "dateEnd" => str_replace("-", "/", $dateEnd), "total" => $total, "mt_egalim" => $mt_egalim, "mt_bio" => $mt_bio, "mt_local" => $mt_local, "tx_egalim" => $tx_egalim, "tx_bio" => $tx_bio, "tx_local" => $tx_local, "tt_articles" => $i, "tt_egalim" => $tt_egalim, "tt_bio" => $tt_bio, "tt_local" => $tt_local, "tt_poids" => $tt_poids, "tt_montant" => $total, "dd_start" => $dateStart, "dd_fin" => $dateEnd, "company" => $company]);
    }

    /**
     * @Route("/Taux_Egalim_Bio_Local/Export/PDF/{ftgnr}/{dateStart}/{dateEnd}/{company}", name="tauxEBL_PDF")
     */
    public function tauxEBL_PDF(Request $request, $ftgnr, $dateStart, $dateEnd, $company)
    {
        $sql = new SQLController();
    
        $i = 0;
        $articles = array();
        
        $mt_egalim = 0;
        $mt_bio = 0;
        $mt_local = 0;
        $tx_egalim = 0;
        $tx_bio = 0;
        $tx_local = 0;
        $total = 0;

        $tt_egalim = 0;
        $tt_bio = 0;
        $tt_local = 0;
        $tt_poids = 0;

        

        $req = $sql->requete("SELECT FA.FtgNr, FA.FtgNamn AS 'Libelle_Client', FA.FtgPostnr AS 'Code_Postal', FA.FtgPostAdr3 AS 'VILLE', AR.q_gcar_lib1 AS 'Libelle_Article', FA.q_is_EGALIM AS 'EGALIM', AR.q_gcar_stat4 AS 'BIO', AR.q_ar_statssurlocal AS 'LOCAL', ROUND(SUM(FA.q_gcbp_ua9), 2) AS 'Poids', ROUND(SUM((FA.vb_FaktRadSumma_Brutto-FA.FaktRadRabSumma)), 2) AS 'Prix_HT' FROM q_2bv_facture AS FA WITH (NOLOCK)
        LEFT JOIN ar AS AR ON AR.ArtNr = FA.ArtNr
        WHERE FA.FtgNr = '".$ftgnr."' AND (FA.FaktDat BETWEEN '".str_replace("-", "/", $dateStart)."' AND '".str_replace("-", "/", $dateEnd)."')
        GROUP BY FA.FtgNr, FA.FtgNamn, FA.FtgPostnr, FA.FtgPostAdr3, AR.q_gcar_lib1, FA.q_is_EGALIM, AR.q_gcar_stat4, AR.q_ar_statssurlocal
        ORDER BY AR.q_gcar_lib1 ASC", $company);

        while ($r = $req->fetch())
        {
            $articles[$i] = $r;
            $total = $total + $r[9];
            $tt_poids = $tt_poids + $r[8];
            $i++;

            if($r[5] == 1){
                $tx_egalim++;
                $mt_egalim = $mt_egalim +  $r[9];
                $tt_egalim++;
            }
            if($r[6] == 191){
                $tx_bio++;
                $mt_bio = $mt_bio +  $r[9];
                $tt_bio++;
            }
            if($r[7] == 10){
                $tx_local++;
                $mt_local = $mt_local +  $r[9];
                $tt_local++;
            }
        }

        if($total != 0){
            $tx_egalim = ($mt_egalim*100)/$total;
            $tx_bio = ($mt_bio*100)/$total;
            $tx_local = ($mt_local*100)/$total;
        }

        $pdfOptions = new Options();
        $pdfOptions->set('isHtml5ParserEnabled', 'true');
        $pdfOptions->set('enable_remote', true);
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->setBasePath($this->getParameter('kernel.project_dir')."/public/");
        $html = $this->renderView('PDF/taux_EBL.html.twig', ["articles" => $articles, "ftgnr" => $ftgnr, "dateStart" => str_replace("-", "/", $dateStart), "dateEnd" => str_replace("-", "/", $dateEnd), "total" => $total, "mt_egalim" => $mt_egalim, "mt_bio" => $mt_bio, "mt_local" => $mt_local, "tx_egalim" => $tx_egalim, "tx_bio" => $tx_bio, "tx_local" => $tx_local, "tt_articles" => $i, "tt_egalim" => $tt_egalim, "tt_bio" => $tt_bio, "tt_local" => $tt_local, "tt_poids" => $tt_poids, "tt_montant" => $total, "company" => $company]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();
        $pdfFilepath =  'PDF/Taux_Egalim_Bio_Local/'.$ftgnr.'_'.$dateStart.'_'.$dateEnd.'.pdf';
        $path = $ftgnr.'_'.$dateStart.'_'.$dateEnd.'.pdf';
        file_put_contents($pdfFilepath, $output);
        
        return $this->redirect('/'.$pdfFilepath);
    }

    /**
     * @Route("/Taux_Egalim_Bio_Local/Export/test/{ftgnr}/{dateStart}/{dateEnd}/{company}", name="tauxEBL_test")
     */
    public function test($ftgnr, $dateStart, $dateEnd, $company)
    {
        $sql = new SQLController();
    
        $i = 0;
        $articles = array();
        
        $mt_egalim = 0;
        $mt_bio = 0;
        $mt_local = 0;
        $tx_egalim = 0;
        $tx_bio = 0;
        $tx_local = 0;
        $total = 0;

        $tt_egalim = 0;
        $tt_bio = 0;
        $tt_local = 0;
        $tt_poids = 0;

        

        $req = $sql->requete("SELECT FA.FtgNr, FA.FtgNamn AS 'Libelle_Client', FA.FtgPostnr AS 'Code_Postal', FA.FtgPostAdr3 AS 'VILLE', AR.q_gcar_lib1 AS 'Libelle_Article', FA.q_is_EGALIM AS 'EGALIM', AR.q_gcar_stat4 AS 'BIO', AR.q_ar_statssurlocal AS 'LOCAL', ROUND(SUM(FA.q_gcbp_ua9), 2) AS 'Poids', ROUND(SUM((FA.vb_FaktRadSumma_Brutto-FA.FaktRadRabSumma)), 2) AS 'Prix_HT' FROM q_2bv_facture AS FA WITH (NOLOCK)
        LEFT JOIN ar AS AR ON AR.ArtNr = FA.ArtNr
        WHERE FA.FtgNr = '".$ftgnr."' AND (FA.FaktDat BETWEEN '".str_replace("-", "/", $dateStart)."' AND '".str_replace("-", "/", $dateEnd)."')
        GROUP BY FA.FtgNr, FA.FtgNamn, FA.FtgPostnr, FA.FtgPostAdr3, AR.q_gcar_lib1, FA.q_is_EGALIM, AR.q_gcar_stat4, AR.q_ar_statssurlocal
        ORDER BY AR.q_gcar_lib1 ASC", $company);

        while ($r = $req->fetch())
        {
            $articles[$i] = $r;
            $total = $total + $r[9];
            $tt_poids = $tt_poids + $r[8];
            $i++;

            if($r[5] == 1){
                $tx_egalim++;
                $mt_egalim = $mt_egalim +  $r[9];
                $tt_egalim++;
            }
            if($r[6] == 191){
                $tx_bio++;
                $mt_bio = $mt_bio +  $r[9];
                $tt_bio++;
            }
            if($r[7] == 10){
                $tx_local++;
                $mt_local = $mt_local +  $r[9];
                $tt_local++;
            }
        }

        if($total != 0){
            $tx_egalim = ($mt_egalim*100)/$total;
            $tx_bio = ($mt_bio*100)/$total;
            $tx_local = ($mt_local*100)/$total;
        }
        
        return $this->render('PDF/taux_EBL.html.twig', ["articles" => $articles, "ftgnr" => $ftgnr, "dateStart" => str_replace("-", "/", $dateStart), "dateEnd" => str_replace("-", "/", $dateEnd), "total" => $total, "mt_egalim" => $mt_egalim, "mt_bio" => $mt_bio, "mt_local" => $mt_local, "tx_egalim" => $tx_egalim, "tx_bio" => $tx_bio, "tx_local" => $tx_local, "tt_articles" => $i, "tt_egalim" => $tt_egalim, "tt_bio" => $tt_bio, "tt_local" => $tt_local, "tt_poids" => $tt_poids, "tt_montant" => $total, "company" => $company]);
    }
}
