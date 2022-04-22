<?php

namespace App\Controller;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\UserInterface;


class SelectSQLController
{
    public function selectSQL($user, $company)
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

        $req = $sql->requete("SELECT varugruppbeskr AS 'GROUPE_ARTICLE' FROM vg ORDER BY varugruppbeskr ASC", $company);
        while ($r = $req->fetch())
        {
            $grp_art[$i] = $r;
            $i++;
        }

        // CHAMPS STATISTIQUE

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'STAT1' FROM q_gcvue_arstat1 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat1[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'STAT2' FROM q_gcvue_arstat2 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat2[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'STAT3' FROM q_gcvue_arstat3 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat3[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'STAT4' FROM q_gcvue_arstat4 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        {
            $stat4[$i] = $r;
            $i++;
        }

        // CHAMPS EGALIM ET LOCAL

        $i = 0;
        $req = $sql->requete("SELECT q_ar_mentionsvalorisantes_lib AS 'MENTION' FROM q_2bt_ar_mentionsvalorisantes ORDER BY q_ar_mentionsvalorisantes_lib ASC", $company);
        while ($r = $req->fetch())
        {
            $men_val[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_2b_ar_liblocal AS 'LOC' FROM q_2bt_ar_local ORDER BY q_2b_ar_liblocal ASC", $company);
        while ($r = $req->fetch())
        {
            $loc[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_ar_rup_lib AS 'RUP' FROM q_2bt_ar_rup ORDER BY q_ar_rup_lib ASC", $company);
        while ($r = $req->fetch())
        {
            $rup[$i] = $r;
            $i++;
        }

        $i = 0;
        $req = $sql->requete("SELECT q_ar_siqo_lib AS 'SIQO' FROM q_2bt_ar_siqo ORDER BY q_ar_siqo_lib ASC", $company);
        while ($r = $req->fetch())
        {
            $siqo[$i] = $r;
            $i++;
        }

        
        $tab = array($grp_art, $stat1, $stat2, $stat3, $stat4, $men_val, $loc, $rup, $siqo);

        return $tab;
    }
}