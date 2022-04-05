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
     * @Route("/fiches_article", name="fichesArticle")
     */
    public function fichesArticle(Request $request): Response
    {
        $allFichesArticle = $this->getDoctrine()->getRepository(FicheArticle::class);
        $articles = $allFichesArticle->findAll();

        return $this->render('FichesArticle/fiches_article.html.twig', ["articles" => $articles]);
    }

    /**
     * @Route("/mes_fiches_article", name="mesFichesArticle")
     */
    public function mesFichesArticle(Request $request, UserInterface $user): Response
    {
        $allFichesArticle = $this->getDoctrine()->getRepository(FicheArticle::class);
        $articles = $allFichesArticle->findBy(array("username" => $user), array("date" => "DESC"));

        return $this->render('FichesArticle/mes_fiches_article.html.twig', ["articles" => $articles]);
    }
}