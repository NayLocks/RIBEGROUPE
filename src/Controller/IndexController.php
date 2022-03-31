<?php

namespace App\Controller;

use App\Controller\SQLController;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $sql = new SQLController();
    
        $req = $sql->requete("SELECT FA.FtgNr, FA.FtgNamn AS 'Libelle_Client', FA.FtgPostnr AS 'Code_Postal', FA.FtgPostAdr3 AS 'VILLE', AR.q_gcar_lib1 AS 'Libelle_Article', FA.q_is_EGALIM AS 'EGALIM', AR.q_gcar_stat4 AS 'BIO', AR.q_ar_statssurlocal AS 'LOCAL', ROUND(SUM(FA.q_gcbp_ua9), 2) AS 'Poids', ROUND(SUM((FA.vb_FaktRadSumma_Brutto-FA.FaktRadRabSumma)), 2) AS 'Prix_HT' FROM q_2bv_facture AS FA WITH(NOLOCK) LEFT JOIN ar AS AR ON AR.ArtNr = FA.ArtNr WHERE FA.FtgNr = 'colbauc' AND (FA.FaktDat BETWEEN '01/01/2022' AND '28/02/2022') GROUP BY FA.FtgNr, FA.FtgNamn, FA.FtgPostnr, FA.FtgPostAdr3, AR.q_gcar_lib1, FA.q_is_EGALIM, AR.q_gcar_stat4, AR.q_ar_statssurlocal ORDER BY AR.q_gcar_lib1 ASC");
        
        
        
        
        while ($r = $req->fetch())
        {
            echo($r[0]." - ".$r[1]." - ".$r[2]." - ".$r[3]." - ".$r[4]." - ".$r[5]." - ".$r[6]." - ".$r[7]." - ".$r[8]."<br>");
        }
        exit();

        return $this->render('base.html.twig');
    }
}
