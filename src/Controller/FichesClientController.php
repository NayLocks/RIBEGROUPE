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
        return $this->render('FichesClient/New_FicheClient.html.twig');
    }
}