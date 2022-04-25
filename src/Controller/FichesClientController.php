<?php

namespace App\Controller;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class FichesClientController extends AbstractController
{
    /**
     * @Route("/fiche_client", name="ficheClient")
     */
    public function index(UserInterface $user)
    {
        $tab = new SelectSQLController();
        $tab = $tab->selectSQLClient($user, $user->getCompany()->getDatabaseName());

        return $this->render('FichesClient/New_FicheClient.html.twig', ["stats1" => $tab[0], "stats2" => $tab[1], "stats3" => $tab[2], "stats4" => $tab[3]]);
    }
}