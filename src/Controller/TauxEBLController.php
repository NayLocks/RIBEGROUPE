<?php

namespace App\Controller;

use App\Controller\SQLController;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class TauxEBLController extends AbstractController
{
    /**
     * @Route("/Taux_Egalim_Bio_Local", name="taux_ebl")
     */
    public function tauxEBL()
    {
        $sql = new SQLController();
    
        $i = 0;
        $clients = array();

        $req = $sql->requete("SELECT REPLACE(k.ftgnr, ' ', '') AS ftgnr, f.ftgnamn, f.ftgpostadr1, f.ftgpostnr, f.ftgpostadr3 FROM kus AS k WITH(NOLOCK)
        LEFT JOIN fr AS f ON f.ftgnr = k.ftgnr WHERE k.q_gctype_tiers_type IS NULL OR k.q_gctype_tiers_type = 'A' ORDER BY f.ftgnr ASC");
        while ($r = $req->fetch())
        {
            $clients[$i] = $r;
            $i++;
        }

        return $this->render('TauxEBL/clients.html.twig', ["clients" => $clients]);
    }

    /**
     * @Route("/Taux_Egalim_Bio_Local/{ftgnr}/{dateStart}/{dateEnd}", name="tauxEBLByClient")
     */
    public function tauxEBLByClient($ftgnr, $dateStart, $dateEnd)
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

        $req = $sql->requete("SELECT FA.FtgNr, FA.FtgNamn AS 'Libelle_Client', FA.FtgPostnr AS 'Code_Postal', FA.FtgPostAdr3 AS 'VILLE', AR.q_gcar_lib1 AS 'Libelle_Article', FA.q_is_EGALIM AS 'EGALIM', AR.q_gcar_stat4 AS 'BIO', AR.q_ar_statssurlocal AS 'LOCAL', ROUND(SUM(FA.q_gcbp_ua9), 2) AS 'Poids', ROUND(SUM((FA.vb_FaktRadSumma_Brutto-FA.FaktRadRabSumma)), 2) AS 'Prix_HT' FROM q_2bv_facture AS FA WITH (NOLOCK)
        LEFT JOIN ar AS AR ON AR.ArtNr = FA.ArtNr
        WHERE FA.FtgNr = '".$ftgnr."' AND (FA.FaktDat BETWEEN '".str_replace("-", "/", $dateStart)."' AND '".str_replace("-", "/", $dateEnd)."')
        GROUP BY FA.FtgNr, FA.FtgNamn, FA.FtgPostnr, FA.FtgPostAdr3, AR.q_gcar_lib1, FA.q_is_EGALIM, AR.q_gcar_stat4, AR.q_ar_statssurlocal
        ORDER BY AR.q_gcar_lib1 ASC");

        while ($r = $req->fetch())
        {
            $articles[$i] = $r;
            $total = $total + $r[9];
            $i++;

            if($r[5] == 1){
                $tx_egalim++;
                $mt_egalim = $mt_egalim +  $r[9];
            }
            if($r[6] == 191){
                $tx_bio++;
                $mt_bio = $mt_bio +  $r[9];
            }
            if($r[7] == 10){
                $tx_local++;
                $mt_local = $mt_local +  $r[9];
            }
        }

        $tx_egalim = ($mt_egalim*100)/$total;
        $tx_bio = ($mt_bio*100)/$total;
        $tx_local = ($mt_local*100)/$total;

        return $this->render('TauxEBL/test.html.twig', ["articles" => $articles, "ftgnr" => $ftgnr, "dateS" => str_replace("-", "/", $dateStart), "dateE" => str_replace("-", "/", $dateEnd), "total" => $total, "mt_egalim" => $mt_egalim, "mt_bio" => $mt_bio, "mt_local" => $mt_local, "tx_egalim" => $tx_egalim, "tx_bio" => $tx_bio, "tx_local" => $tx_local]);
    }
}
