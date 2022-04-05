<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UsersController extends AbstractController
{
    /**
     * @Route("/utilisateurs", name="users")
     */
    public function users(Request $request): Response
    {
        $allUsers = $this->getDoctrine()->getRepository(User::class);
        $users = $allUsers->findAll();
        
        return $this->render('Admin/Users/users.html.twig', ["users" => $users]);        
    }

    /**
     * @Route("/utilisateurs/droits/{id}/{access}/{on}", name="editAccessUser")
     */
    public function editAccessUser(Request $request, $id, $access, $on): Response
    {
        $allUsers = $this->getDoctrine()->getRepository(User::class);
        $users = $allUsers->findOneBy(array("id" => $id));

        $em = $this->getDoctrine()->getManager();

        if($access == "FC")
        {
            $users->setAccessFC($on);
            $em->persist($users);
            $em->flush();
        }else if($access == "FA")
        {
            $users->setAccessFA($on);
            $em->persist($users);
            $em->flush();
        }else if($access == "FF")
        {
            $users->setAccessFF($on);
            $em->persist($users);
            $em->flush();
        }else if($access == "ADM")
        {
            $users->setAccessADM($on);
            $em->persist($users);
            $em->flush();
        }
        
        return $this->redirectToRoute("users");
    }
}