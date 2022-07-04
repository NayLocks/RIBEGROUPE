<?php

namespace App\Controller;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\VarDumper\VarDumper;

class SelectSQL
{
    public function selectSQLItemFields($company)
    {
        $sql = new SQL\SQLController();

        // GROUPE ARTICLE
        $i = 0;
        $groupItem = array();
        $req = $sql->requete("SELECT varugruppbeskr, varugruppkod FROM vg ORDER BY varugruppbeskr ASC", $company);
        while ($r = $req->fetch())
        { $groupItem[$i] = $r; $i++; }

        // DEBUT CHAMPS STATISTIQUES
        $i = 0;
        $stat1 = array();
        $req = $sql->requete("SELECT q_gcstat_lib1, q_gcstat_code FROM q_gcvue_arstat1 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        { $stat1[$i] = $r; $i++; }

        $i = 0;
        $stat2 = array();
        $req = $sql->requete("SELECT q_gcstat_lib1, q_gcstat_code FROM q_gcvue_arstat2 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        { $stat2[$i] = $r; $i++; }

        $i = 0;
        $stat3 = array();
        $req = $sql->requete("SELECT q_gcstat_lib1, q_gcstat_code FROM q_gcvue_arstat3 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        { $stat3[$i] = $r; $i++; }

        $i = 0;
        $stat4 = array();
        $req = $sql->requete("SELECT q_gcstat_lib1, q_gcstat_code FROM q_gcvue_arstat4 ORDER BY q_gcstat_lib1 ASC", $company);
        while ($r = $req->fetch())
        { $stat4[$i] = $r; $i++; }
        // FIN CHAMPS STATISTIQUES


        // DEBUT CHAMPS EGALIM ET LOCAL
        $i = 0;
        $noticeAccentuate = array();
        $req = $sql->requete("SELECT q_ar_mentionsvalorisantes_lib, q_ar_mentionsvalorisantes FROM q_2bt_ar_mentionsvalorisantes ORDER BY q_ar_mentionsvalorisantes_lib ASC", $company);
        while ($r = $req->fetch())
        { $noticeAccentuate[$i] = $r; $i++; }

        $i = 0;
        $localization = array();
        $req = $sql->requete("SELECT q_2b_ar_liblocal, q_2b_ar_idlocal FROM q_2bt_ar_local ORDER BY q_2b_ar_liblocal ASC", $company);
        while ($r = $req->fetch())
        { $localization[$i] = $r; $i++; }

        $i = 0;
        $rup = array();
        $req = $sql->requete("SELECT q_ar_rup_lib, q_ar_rup FROM q_2bt_ar_rup ORDER BY q_ar_rup_lib ASC", $company);
        while ($r = $req->fetch())
        { $rup[$i] = $r; $i++; }

        $i = 0;
        $siqo = array();
        $req = $sql->requete("SELECT q_ar_siqo_lib, q_ar_siqo FROM q_2bt_ar_siqo ORDER BY q_ar_siqo_lib ASC", $company);
        while ($r = $req->fetch())
        { $siqo[$i] = $r; $i++; }
        // FIN CHAMPS EGALIM ET LOCAL
        
        $tab = array($groupItem, $stat1, $stat2, $stat3, $stat4, $noticeAccentuate, $localization, $rup, $siqo);
        return $tab;
    }

    public function selectSQLItemCode($company, $itemSheet)
    {
        $sql = new SQL\SQLController();
        
        // GROUPE ARTICLE
        $i = 0;
        $groupItem = "";
        $req = $sql->requete("SELECT varugruppbeskr, varugruppkod FROM vg WHERE varugruppkod = '".$itemSheet->getGroupItem()."' ", $company);
        while ($r = $req->fetch())
        { $groupItem = $r; $i++; }
        if($groupItem == ""){ $groupItem = array("", ""); }

        // DEBUT CHAMPS STATISTIQUES
        $i = 0;
        $stat1 = "";
        $req = $sql->requete("SELECT q_gcstat_lib1, q_gcstat_code FROM q_gcvue_arstat1 WHERE q_gcstat_code = '".$itemSheet->getStat1()."' ", $company);
        while ($r = $req->fetch())
        { $stat1 = $r; $i++; }
        if($stat1 == ""){ $stat1 = array("", ""); }

        $i = 0;
        $stat2 = "";
        $req = $sql->requete("SELECT q_gcstat_lib1, q_gcstat_code FROM q_gcvue_arstat2 WHERE q_gcstat_code = '".$itemSheet->getStat2()."' ", $company);
        while ($r = $req->fetch())
        { $stat2 = $r; $i++; }
        if($stat2 == ""){ $stat2 = array("", ""); }

        $i = 0;
        $stat3 = "";
        $req = $sql->requete("SELECT q_gcstat_lib1, q_gcstat_code FROM q_gcvue_arstat3 WHERE q_gcstat_code = '".$itemSheet->getStat3()."' ", $company);
        while ($r = $req->fetch())
        { $stat3 = $r; $i++; }
        if($stat3 == ""){ $stat3 = array("", ""); }

        $i = 0;
        $stat4 = "";
        $req = $sql->requete("SELECT q_gcstat_lib1, q_gcstat_code FROM q_gcvue_arstat4 WHERE q_gcstat_code = '".$itemSheet->getStat4()."' ", $company);
        while ($r = $req->fetch())
        { $stat4 = $r; $i++; }
        if($stat4 == ""){ $stat4 = array("", ""); }
        // FIN CHAMPS STATISTIQUES

        // DEBUT CHAMPS EGALIM ET LOCAL
        $i = 0;
        $noticeAccentuate = "";
        $req = $sql->requete("SELECT q_ar_mentionsvalorisantes_lib, q_ar_mentionsvalorisantes FROM q_2bt_ar_mentionsvalorisantes WHERE q_ar_mentionsvalorisantes = '".$itemSheet->getNoticeAccentuate()."' ", $company);
        while ($r = $req->fetch())
        { $noticeAccentuate = $r; $i++; }
        if($noticeAccentuate == ""){ $noticeAccentuate = array("", ""); }

        $i = 0;
        $localization = "";
        $req = $sql->requete("SELECT q_2b_ar_liblocal, q_2b_ar_idlocal FROM q_2bt_ar_local WHERE q_2b_ar_idlocal = '".$itemSheet->getLocalization()."' ", $company);
        while ($r = $req->fetch())
        { $localization = $r; $i++; }
        if($localization == ""){ $localization = array("", ""); }

        $i = 0;
        $rup = "";
        $req = $sql->requete("SELECT q_ar_rup_lib, q_ar_rup FROM q_2bt_ar_rup WHERE q_ar_rup = '".$itemSheet->getRup()."' ", $company);
        while ($r = $req->fetch())
        { $rup = $r; $i++; }
        if($rup == ""){ $rup = array("", ""); }

        $i = 0;
        $siqo = "";
        $req = $sql->requete("SELECT q_ar_siqo_lib, q_ar_siqo FROM q_2bt_ar_siqo WHERE q_ar_siqo = '".$itemSheet->getSiqo()."' ", $company);
        while ($r = $req->fetch())
        { $siqo = $r; $i++; }
        if($siqo == ""){ $siqo = array("", ""); }
        // FIN CHAMPS EGALIM ET LOCAL
        
        $tab = array($groupItem, $stat1, $stat2, $stat3, $stat4, $noticeAccentuate, $localization, $rup, $siqo);
        return $tab;
    }




    public function selectSQLCustomer($company, $code)
    {
        $sql = new SQL\SQLController();
        $i = 0;

        $stat1 = array();
        $stat2 = array();
        $stat3 = array();
        $stat4 = array();
        $stat5 = array();
        $tournees = array();
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

        $req = $sql->requete("SELECT saljarenamn AS 'COMMERCIAL', saljare FROM salj WHERE saljteamkod != '99' OR saljteamkod IS NULL AND SaljareNamn NOT LIKE '%NE PAS UTILISER%' ORDER BY saljarenamn ASC", $company);
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

        if($company == "RIBEGROUPE" || $company == "PROMER" || $company == "RIBEXPE" || $company == "BIOEMOI"|| $company == "HOLDING")
        {        
            $req = $sql->requete("SELECT ('(' + q_gctournee_tournee + ') - ' + q_2b_libtournee) AS 'Libelle_TOURNEE', q_gctournee_tournee AS 'Code_TOURNEE' FROM q_2bt_tournee ORDER BY q_2b_libtournee ASC", "HOLDING");
        }else{
            $req = $sql->requete("SELECT ('(' + q_gctournee_tournee + ') - ' + q_2b_libtournee) AS 'Libelle_TOURNEE', q_gctournee_tournee AS 'Code_TOURNEE' FROM q_2bt_tournee WHERE ftgnr = '".$code."' ORDER BY q_2b_libtournee ASC", "HOLDING");
        }
        while ($r = $req->fetch())
        {
            $tournees[$i] = $r;
            $i++;
        }
        
        $tab = array($stat1, $stat2, $stat3, $stat4, $stat5, $tournees, $commercial, $televente);

        return $tab;
    }

    public function selectSQLClientCode($user, $company, $client)
    {
        $sql = new SQL\SQLController();

        $stat1 = "";
        $stat2 = "";
        $stat3 = "";
        $stat4 = "";
        $stat5 = "";
        
        $trLundi = "";
        $trMardi = "";
        $trMercredi = "";
        $trJeudi = "";
        $trVendredi = "";
        $trSamedi = "";

        $comMaitre = "";
        $com = "";
        $tel = "";

        // CHAMPS STAT
        
        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT1', q_gcstat_code AS 'Code_STAT1' FROM q_gcvue_kusstat1 WHERE q_gcstat_code = '".$client->getStat1()."' ", $company);
        while ($r = $req->fetch())
        {
            $stat1 = $r;
            $i++;
        }
        
        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT2', q_gcstat_code AS 'Code_STAT2' FROM q_gcvue_kusstat2 WHERE q_gcstat_code = '".$client->getStat2()."' ", $company);
        while ($r = $req->fetch())
        {
            $stat2 = $r;
            $i++;
        }
        
        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT3', q_gcstat_code AS 'Code_STAT3' FROM q_gcvue_kusstat3 WHERE q_gcstat_code = '".$client->getStat3()."' ", $company);
        while ($r = $req->fetch())
        {
            $stat3 = $r;
            $i++;
        }
        
        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT4', q_gcstat_code AS 'Code_STAT4' FROM q_gcvue_kusstat4 WHERE q_gcstat_code = '".$client->getStat4()."' ", $company);
        while ($r = $req->fetch())
        {
            $stat4 = $r;
            $i++;
        }
        
        $i = 0;
        $req = $sql->requete("SELECT q_gcstat_lib1 AS 'Libelle_STAT5', q_gcstat_code AS 'Code_STAT5' FROM q_gcvue_kusstat5 WHERE q_gcstat_code = '".$client->getStat5()."' ", $company);
        while ($r = $req->fetch())
        {
            $stat5 = $r;
            $i++;
        }

        // TOURNEES
        
        $i = 0;
        $req = $sql->requete("SELECT ('(' + q_gctournee_tournee + ') - ' + q_2b_libtournee) AS 'Libelle_TOURNEE_LU', q_gctournee_tournee AS 'Code_TOURNEE_LU' FROM q_2bt_tournee WHERE q_gctournee_tournee = '".$client->getTrLundi()."' ", "HOLDING");
        while ($r = $req->fetch())
        {
            $trLundi = $r;
            $i++;
        }
        
        $i = 0;
        $req = $sql->requete("SELECT ('(' + q_gctournee_tournee + ') - ' + q_2b_libtournee) AS 'Libelle_TOURNEE_MA', q_gctournee_tournee AS 'Code_TOURNEE_MA' FROM q_2bt_tournee WHERE q_gctournee_tournee = '".$client->getTrMardi()."' ", "HOLDING");
        while ($r = $req->fetch())
        {
            $trMardi = $r;
            $i++;
        }
        
        $i = 0;
        $req = $sql->requete("SELECT ('(' + q_gctournee_tournee + ') - ' + q_2b_libtournee) AS 'Libelle_TOURNEE_ME', q_gctournee_tournee AS 'Code_TOURNEE_ME' FROM q_2bt_tournee WHERE q_gctournee_tournee = '".$client->getTrMercredi()."' ", "HOLDING");
        while ($r = $req->fetch())
        {
            $trMercredi = $r;
            $i++;
        }
        
        $i = 0;
        $req = $sql->requete("SELECT ('(' + q_gctournee_tournee + ') - ' + q_2b_libtournee) AS 'Libelle_TOURNEE_JE', q_gctournee_tournee AS 'Code_TOURNEE_JE' FROM q_2bt_tournee WHERE q_gctournee_tournee = '".$client->getTrJeudi()."' ", "HOLDING");
        while ($r = $req->fetch())
        {
            $trJeudi = $r;
            $i++;
        }
        
        $i = 0;
        $req = $sql->requete("SELECT ('(' + q_gctournee_tournee + ') - ' + q_2b_libtournee) AS 'Libelle_TOURNEE_VE', q_gctournee_tournee AS 'Code_TOURNEE_VE' FROM q_2bt_tournee WHERE q_gctournee_tournee = '".$client->getTrVendredi()."' ", "HOLDING");
        while ($r = $req->fetch())
        {
            $trVendredi = $r;
            $i++;
        }
        
        $i = 0;
        $req = $sql->requete("SELECT ('(' + q_gctournee_tournee + ') - ' + q_2b_libtournee) AS 'Libelle_TOURNEE_SA', q_gctournee_tournee AS 'Code_TOURNEE_SA' FROM q_2bt_tournee WHERE q_gctournee_tournee = '".$client->getTrSamedi()."' ", "HOLDING");
        while ($r = $req->fetch())
        {
            $trSamedi = $r;
            $i++;
        }

        // CHAMP COM_MAITRE COM TEL
        
        $i = 0;
        $req = $sql->requete("SELECT saljarenamn AS 'COMMERCIAL', saljare FROM salj WHERE saljare = '".$client->getComMaitre()."' ", $company);
        while ($r = $req->fetch())
        {
            $comMaitre = $r;
            $i++;
        }
        
        $i = 0;
        $req = $sql->requete("SELECT saljarenamn AS 'COMMERCIAL', saljare FROM salj WHERE saljare = '".$client->getCom()."' ", $company);
        while ($r = $req->fetch())
        {
            $com = $r;
            $i++;
        }
        
        $i = 0;
        $req = $sql->requete("SELECT (us.respnamn + ' - (' + perssign1 + ')') AS 'TELEVENDEUR', perssign1 FROM q_2bt_gc_televendeur JOIN sy2 AS us ON us.PersSign = q_2bt_gc_televendeur.perssign1 WHERE perssign1 = '".$client->getTel()."' ", $company);
        while ($r = $req->fetch())
        {
            $tel = $r;
            $i++;
        }

        
        $tab = array($stat1, $stat2, $stat3, $stat4, $stat5, $trLundi, $trMardi, $trMercredi, $trJeudi, $trVendredi, $trSamedi, $comMaitre, $com, $tel);

        return $tab;
    }
}