<?php

namespace App\Controller;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(UserInterface $user)
    {
        return $this->render('index.html.twig');
    }
}