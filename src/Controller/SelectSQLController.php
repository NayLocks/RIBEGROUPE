<?php

namespace App\Controller;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\UserInterface;


class SelectSQLController
{
    public function selectSQLArticle($user, $company)
    {
        $sql = new SQL\SQLController();
        $i = 0;
        $grp_art = array();

        $stat1 = array();
        $stat2 = array();
        $stat3 = array();
        $stat4 = array();

        $men_val = array();
        $loc = array();
        $rup = array();
        $siqo = array();

        $req = $sql->requete("SELECT varugruppbeskr AS 'Libelle_GROUPE_ARTICLE', varugruppkod AS 'Code_GROUPE_ARTICLE' FROM vg ORDER BY varugruppbeskr ASC", $company);
        while ($r = $req->fetch())
        {
            $grp_art[$i] = $r;
            $i++;
        }

        // CHAMPS STATISTIQUE

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT1', q_gcstat_code AS 'Code_STAT1' FROM q_gcvue_arstat1 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat1[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT2', q_gcstat_code AS 'Code_STAT2' FROM q_gcvue_arstat2 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat2[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT3', q_gcstat_code AS 'Code_STAT3' FROM q_gcvue_arstat3 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat3[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT4', q_gcstat_code AS 'Code_STAT4' FROM q_gcvue_arstat4 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat4[$i] = $r;
            $i++;
        }

        // CHAMPS EGALIM ET LOCAL

        $i = 0;
        $req = $sql->requete("SELECT q_ar_mentionsvalorisantes_lib AS 'Libelle_MENTION', q_ar_mentionsvalorisantes AS 'Code_MENTION' FROM q_2bt_ar_mentionsvalorisantes ORDER BY q_ar_mentionsvalorisantes_lib ASC", $company);
        while ($r = $req->fetch())
        {
            $men_val[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_2b_ar_liblocal AS 'Libelle_LOCALISATION', q_2b_ar_idlocal AS 'Code_LOCALISATION' FROM q_2bt_ar_local ORDER BY q_2b_ar_liblocal ASC", $company);
        while ($r = $req->fetch())
        {
            $loc[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_ar_rup_lib AS 'Libelle_RUP', q_ar_rup AS 'Code_RUP' FROM q_2bt_ar_rup ORDER BY q_ar_rup_lib ASC", $company);
        while ($r = $req->fetch())
        {
            $rup[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_ar_siqo_lib AS 'Libelle_SIQO', q_ar_siqo AS 'Code_SIQO' FROM q_2bt_ar_siqo ORDER BY q_ar_siqo_lib ASC", $company);
        while ($r = $req->fetch())
        {
            $siqo[$i] = $r;
            $i++;
        }

        
        $tab = array($grp_art, $stat1, $stat2, $stat3, $stat4, $men_val, $loc, $rup, $siqo);

        return $tab;
    }

    public function selectSQLArticleCode($user, $company, $article)
    {
        $sql = new SQL\SQLController();
        $i = 0;
        $grp_art = "";

        $stat1 = "";
        $stat2 = "";
        $stat3 = "";
        $stat4 = "";

        $men_val = "";
        $loc = "";
        $rup = "";
        $siqo = "";

        $req = $sql->requete("SELECT varugruppbeskr AS 'Libelle_GROUPE_ARTICLE', varugruppkod AS 'Code_GROUPE_ARTICLE' FROM vg WHERE varugruppkod = '".$article->getGrpArticle()."' ", $company);
        while ($r = $req->fetch())
        {
            $grp_art = $r;
            $i++;
        }

        // CHAMPS STATISTIQUE

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT1', q_gcstat_code AS 'Code_STAT1' FROM q_gcvue_arstat1 WHERE q_gcstat_code = '".$article->getStat1()."' ", $company);
        while ($r = $req->fetch())
        {
            $stat1 = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT2', q_gcstat_code AS 'Code_STAT2' FROM q_gcvue_arstat2 WHERE q_gcstat_code = '".$article->getStat2()."' ", $company);
        while ($r = $req->fetch())
        {
            $stat2 = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT3', q_gcstat_code AS 'Code_STAT3' FROM q_gcvue_arstat3 WHERE q_gcstat_code = '".$article->getStat3()."' ", $company);
        while ($r = $req->fetch())
        {
            $stat3 = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT4', q_gcstat_code AS 'Code_STAT4' FROM q_gcvue_arstat4 WHERE q_gcstat_code = '".$article->getStat4()."' ", $company);
        while ($r = $req->fetch())
        {
            $stat4 = $r;
            $i++;
        }

        // CHAMPS EGALIM ET LOCAL

        $i = 0;
        $req = $sql->requete("SELECT q_ar_mentionsvalorisantes_lib AS 'Libelle_MENTION', q_ar_mentionsvalorisantes AS 'Code_MENTION' FROM q_2bt_ar_mentionsvalorisantes WHERE q_ar_mentionsvalorisantes = '".$article->getMenVal()."' ", $company);
        while ($r = $req->fetch())
        {
            $men_val = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_2b_ar_liblocal AS 'Libelle_LOCALISATION', q_2b_ar_idlocal AS 'Code_LOCALISATION' FROM q_2bt_ar_local WHERE q_2b_ar_idlocal = '".$article->getLocalisation()."' ", $company);
        while ($r = $req->fetch())
        {
            $loc = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_ar_rup_lib AS 'Libelle_RUP', q_ar_rup AS 'Code_RUP' FROM q_2bt_ar_rup WHERE q_ar_rup = '".$article->getRup()."' ", $company);
        while ($r = $req->fetch())
        {
            $rup = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_ar_siqo_lib AS 'Libelle_SIQO', q_ar_siqo AS 'Code_SIQO' FROM q_2bt_ar_siqo WHERE q_ar_siqo = '".$article->getSiqo()."' ", $company);
        while ($r = $req->fetch())
        {
            $siqo = $r;
            $i++;
        }

        
        $tab = array($grp_art, $stat1, $stat2, $stat3, $stat4, $men_val, $loc, $rup, $siqo);

        return $tab;
    }

    public function selectSQLClient($user, $company)
    {
        $sql = new SQL\SQLController();
        $i = 0;

        $stat1 = array();
        $stat2 = array();
        $stat3 = array();
        $stat4 = array();
        $stat5 = array();
        $commercial = array();
        $televente = array();

        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT1', q_gcstat_code AS 'Code_STAT1' FROM q_gcvue_kusstat1 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat1[$i] = $r;
            $i++;
        }

        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT2', q_gcstat_code AS 'Code_STAT2' FROM q_gcvue_kusstat2 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat2[$i] = $r;
            $i++;
        }

        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT3', q_gcstat_code AS 'Code_STAT3' FROM q_gcvue_kusstat3 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat3[$i] = $r;
            $i++;
        }

        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT4', q_gcstat_code AS 'Code_STAT4' FROM q_gcvue_kusstat4 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat4[$i] = $r;
            $i++;
        }

        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT5', q_gcstat_code AS 'Code_STAT5' FROM q_gcvue_kusstat5 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat5[$i] = $r;
            $i++;
        }

        $req = $sql->requete("SELECT saljarenamn AS 'COMMERCIAL', saljteamkod FROM salj WHERE saljteamkod != '99' OR saljteamkod IS NULL AND SaljareNamn NOT LIKE '%NE PAS UTILISER%' ORDER BY saljarenamn ASC", $company);
        while ($r = $req->fetch())
        {
            $commercial[$i] = $r;
            $i++;
        }

        $req = $sql->requete("SELECT (us.respnamn + ' - (' + perssign1 + ')') AS 'TELEVENDEUR', perssign1 FROM q_2bt_gc_televendeur JOIN sy2 AS us ON us.PersSign = q_2bt_gc_televendeur.perssign1 ORDER BY q_2bt_gc_televendeur.perssign1 ASC", $company);
        while ($r = $req->fetch())
        {
            $televente[$i] = $r;
            $i++;
        }
        
        $tab = array($stat1, $stat2, $stat3, $stat4, $stat5, $commercial, $televente);

        return $tab;
    }
    public function selectSQLTournees($user, $company)
    {
        $sql = new SQL\SQLController();
        $i = 0;

        $tournees = array();

        if($company == "RIBEGROUPE" || $company == "PROMER" || $company == "RIBEXPE" || $company == "BIOEMOI")
        {        
            $req = $sql->requete("SELECT ('(' + q_gctournee_tournee + ') - ' + q_2b_libtournee) AS 'Libelle_TOURNEE', q_gctournee_tournee AS 'Code_TOURNEE' FROM q_2bt_tournee ORDER BY q_2b_libtournee ASC", "HOLDING");
        }else{
            $req = $sql->requete("SELECT ('(' + q_gctournee_tournee + ') - ' + q_2b_libtournee) AS 'Libelle_TOURNEE', q_gctournee_tournee AS 'Code_TOURNEE' FROM q_2bt_tournee ORDER BY q_2b_libtournee ASC", $company);
        }
        while ($r = $req->fetch())
        {
            $tournees[$i] = $r;
            $i++;
        }
        
        $tab = array($tournees);

        return $tab;
    }
}