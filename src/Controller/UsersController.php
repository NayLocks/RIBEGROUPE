<?php

namespace App\Controller;

use App\Entity\Companies;
use App\Entity\User;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UsersController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/utilisateurs", name="users")
     */
    public function users(Request $request): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $companies = $this->getDoctrine()->getRepository(Companies::class)->findAll();

        if(isset($_POST["id"])){
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(array("id" => $_POST["id"]));

            $company = $this->getDoctrine()->getRepository(Companies::class)->findOneBy(array("name" => $_POST["company"]));

            if(isset($_POST["accessADM"])){
                $_POST["accessADM"] = 1;
            }else{
                $_POST["accessADM"] = 0;
            }
            if(isset($_POST["accessFC"])){
                $_POST["accessFC"] = 1;
            }else{
                $_POST["accessFC"] = 0;
            }
            if(isset($_POST["accessFA"])){
                $_POST["accessFA"] = 1;
            }else{
                $_POST["accessFA"] = 0;
            }

            $user->setLastName($_POST["lastName"]);
            $user->setFirstName($_POST["firstName"]);
            $user->setEmail($_POST["email"]);
            $user->setCompany($company);
            
            $user->setAccessADM($_POST["accessADM"]);
            $user->setAccessFC($_POST["accessFC"]);
            $user->setAccessFA($_POST["accessFA"]);

            $user->setTitleFC($_POST["titleFC"]);
            $user->setTitleFA($_POST["titleFA"]);

            $user->setUsername($_POST["username"]);
            if(!empty($_POST["password"])){
                $user->setPassword($this->passwordEncoder->encodePassword($user, $_POST["password"]));
            }   
            $user->setRoles(['ROLE_ADMIN']);


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('users');
        }
        
        return $this->render('Admin/Users/users.html.twig', ["users" => $users, "companies" => $companies]);        
    }

    public function userEdit(Request $request, $users, $companies): Response
    {
        return $this->render('Admin/Users/userEdit.html.twig', ["users" => $users, "companies" => $companies]);
    }
}