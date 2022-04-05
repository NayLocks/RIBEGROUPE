<?php

namespace App\Controller\SQL;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\UserInterface;


class SQLControllerPromer
{
    function __construct()
    {        
        $this->connexion_bdd = new \PDO('sqlsrv:Server=192.168.1.241;Database=PROMER', 'sa', '2bsystem99');
        $this->connexion_bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    
    public function requete($requete)
    {
        $prepare = $this->connexion_bdd->prepare($requete);
        $prepare->execute();
        
        return $prepare;
    }
}