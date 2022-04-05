<?php

namespace App\Controller\SQL;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\UserInterface;


class SQLController
{
    public function requete($requete, $company)
    {
        if($company == "RIBEGROUPE"){
            $sql = new SQLControllerRibeGroupe();
            $req = $sql->requete($requete);
        }
        if($company == "ARDENNES"){
            $sql = new SQLControllerArdennes();
            $req = $sql->requete($requete);
        }
        if($company == "RIVOALLON"){
            $sql = new SQLControllerRivoAllon();
            $req = $sql->requete($requete);
        }
        if($company == "RIBEPRIM"){
            $sql = new SQLControllerRibePrim();
            $req = $sql->requete($requete);
        }
        if($company == "PROMER"){
            $sql = new SQLControllerPromer();
            $req = $sql->requete($requete);
        }
        if($company == "BIOEMOI"){
            $sql = new SQLControllerBioEMoi();
            $req = $sql->requete($requete);
        }
        if($company == "RIBEXPE"){
            $sql = new SQLControllerRibexpe();
            $req = $sql->requete($requete);
        }
        if($company == "RODAFRUITS"){
            $sql = new SQLControllerRodaFruits();
            $req = $sql->requete($requete);
        }
        
        return $req;
    }
}