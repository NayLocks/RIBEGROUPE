<?php

namespace App\Controller;

use App\Entity\FicheArticle;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class FichesArticleController extends AbstractController
{
    /**
     * @Route("/nouvelle_fiches_article", name="newFicheArticle")
     */
    public function NewFicheArticle(Request $request): Response
    {
        return $this->render('FichesArticle/New_FicheArticle.html.twig');
    }

    /**
     * @Route("/fiches_article", name="ficheArticle")
     */
    public function ficheArticle(Request $request): Response
    {
        $allFichesArticle = $this->getDoctrine()->getRepository(FicheArticle::class);
        $articles = $allFichesArticle->findAll();

        return $this->render('FichesArticle/FicheArticle.html.twig', ["articles" => $articles]);
    }

    /**
     * @Route("/mes_fiches_article", name="myFicheArticle")
     */
    public function MyFicheArticle(Request $request, UserInterface $user): Response
    {
        $allFichesArticle = $this->getDoctrine()->getRepository(FicheArticle::class);
        $articles = $allFichesArticle->findBy(array("username" => $user), array("date" => "DESC"));

        return $this->render('FichesArticle/My_FicheArticle.html.twig', ["articles" => $articles]);
    }
}