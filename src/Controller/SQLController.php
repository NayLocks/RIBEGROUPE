<?php

namespace App\Controller;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SQLController
{
    private $connexion_sql;
    
    function __construct()
    {
        $this->connexion_bdd = new \PDO('sqlsrv:Server=192.168.1.241;Database=RIBEPRIM', 'sa', '2bsystem99');

        // Fixe les options d'erreur (ici nous utiliserons les exceptions)
        $this->connexion_bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    
    public function requete($requete)
    {
        $prepare = $this->connexion_bdd->prepare($requete);
        $prepare->execute();
        
        return $prepare;
    }
}