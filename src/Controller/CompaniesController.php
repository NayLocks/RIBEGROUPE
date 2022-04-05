<?php

namespace App\Controller;

use App\Entity\Companies;
use App\Form\CompanyFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class CompaniesController extends AbstractController
{
    /**
     * @Route("/societes", name="companies")
     */
    public function companies(Request $request): Response
    {
        $allCompanies = $this->getDoctrine()->getRepository(Companies::class);
        $companies = $allCompanies->findAll();

        $company = new Companies();
        $form = $this->createForm(CompanyFormType::class, $company);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $company = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('companies');
        }

        if(isset($_POST["id"])){
            $allCompanies = $this->getDoctrine()->getRepository(Companies::class);
            $company = $allCompanies->findOneBy(array("id" => $_POST["id"]));

            $company->setName($_POST["name"]);
            $company->setColorCode($_POST["colorCode"]);
            $company->setColorText($_POST["colorText"]);
            $company->setDatabaseName($_POST["databaseName"]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            return $this->redirectToRoute('companies');
        }

        return $this->render('Admin/Companies/companies.html.twig', ["companies" => $companies, "form" => $form->createView()]);
    }

    public function companyEdit(Request $request, $companies): Response
    {
        return $this->render('Admin/Companies/companyEdit.html.twig', ["companies" => $companies]);
    }
}