<?php

namespace App\Controller;

use App\Entity\CustomersSheets;
use App\Entity\ItemsSheets;
use Dompdf\Dompdf;
use Dompdf\Options;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class TestController extends AbstractController
{
    /********************************** FICHE CLIENT **********************************/

    /**
    * @Route("/fiches_clients/test/html/", name="testHTMLCustomerSheet")
    */
    public function testHTMLCustomerSheet(): Response
    {
        $customerSheet = $this->getDoctrine()->getRepository(CustomersSheets::class)->findOneBy(array("id" => 1));
           
        return $this->render('CustomersSheets/PDF_CustomerSheet.html.twig', ["customerSheet"=> $customerSheet]);
    }

    /**
     * @Route("/fiches_clients/test/pdf/", name="testPDFCustomerSheet")
     */
    public function testPDFCustomerSheet(): Response
    {
        $customerSheet = $this->getDoctrine()->getRepository(CustomersSheets::class)->findOneBy(array("id" => 1));
    
        $pdfOptions = new Options();
        $pdfOptions->set('isHtml5ParserEnabled', 'true');
        $pdfOptions->set('enable_remote', true);
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->setBasePath($this->getParameter('kernel.project_dir')."/public/");
        $html = $this->renderView('CustomersSheets/PDF_CustomerSheet.html.twig', ["customerSheet"=> $customerSheet]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();
        $pdfFilepath =  'Documents/TEST/Fiche_Client_'.$customerSheet->getId().'.pdf';
        file_put_contents($pdfFilepath, $output);
        
        return $this->redirect('/'.$pdfFilepath);
    }

    /**
     * @Route("/fiches_client/test/mail/", name="testMailCustomerSheet")
     */
    public function testMailCustomerSheet(MailerInterface $mailer)
    {
        $customerSheet = $this->getDoctrine()->getRepository(CustomersSheets::class)->findOneBy(array("id" => 1));

        $email = (new Email())
            ->from(new Address('fax_mail@ribegroupe.com'))
            ->to('jonathan.delannoy@ribegroupe.com')
            ->subject('FICHE CLIENT ['.$customerSheet->getCompany()->getName().'] : VISUALISATION TEST')
            ->embed(fopen('images/background.jpg', 'r'), 'imgP')
            ->html($this->renderView('CustomersSheets/Mail_CustomerSheet.html.twig', ["customerSheet" => $customerSheet, 'url' => '/fiches_clients/test/pdf/']));

        $mailer->send($email);

        return $this->redirectToRoute("index");
    }


    /********************************** FICHE ARTICLE **********************************/

    /**
     * @Route("/fiches_articles/test/html/", name="test_HTML_ItemSheet")
     */
    public function htmlItemSheet(UserInterface $user): Response
    {
        $allItemsSheets = $this->getDoctrine()->getRepository(ItemsSheets::class);
        $itemSheet = $allItemsSheets->findOneBy(array("id" => 0));
        
        $champs = new SelectSQL();
        $ItemFields = $champs->selectSQLItemCode($user->getCompany()->getDatabaseName(), $itemSheet);
                
        if(!file_exists('Documents/Fiches_Articles/'.$itemSheet->getId())){
            mkdir('Documents/Fiches_Articles/'.$itemSheet->getId());
        }

        return $this->render('ItemsSheets/PDF_ItemsSheets.html.twig', ["item"=> $itemSheet, "itemFields" => $ItemFields]);
    }

    /**
     * @Route("/fiches_articles/test/pdf/", name="test_PDF_ItemSheet")
     */
    public function pdfItemSheet(UserInterface $user): Response
    {
        $allItemsSheets = $this->getDoctrine()->getRepository(ItemsSheets::class);
        $itemSheet = $allItemsSheets->findOneBy(array("id" => 0));
        
        $champs = new SelectSQL();
        $ItemFields = $champs->selectSQLItemCode($user->getCompany()->getDatabaseName(), $itemSheet);
                
        if(!file_exists('Documents/TEST/Fiches_Articles')){
            mkdir('Documents/TEST/Fiches_Articles');
        }

        $pdfOptions = new Options();
        $pdfOptions->set('isHtml5ParserEnabled', 'true');
        $pdfOptions->set('enable_remote', true);
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->setBasePath($this->getParameter('kernel.project_dir')."/public/");
        $html = $this->renderView('ItemsSheets/PDF_ItemsSheets.html.twig', ["item"=> $itemSheet, "itemFields" => $ItemFields]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();
        $pdfFilepath =  'Documents/TEST/Fiche_Article_'.$itemSheet->getId().'.pdf';
        $path = 'Fiche_Article_'.$itemSheet->getId().'.pdf';
        file_put_contents($pdfFilepath, $output);
        
        return $this->redirect('/'.$pdfFilepath);
    }

    /**
     * @Route("/fiches_articles/test/mail/", name="testMailItemSheet")
     */
    public function testMailItemSheet(UserInterface $user, MailerInterface $mailer)
    {
        $email = (new Email())
            ->from(new Address('jonathan.delannoy@ribegroupe.com', 'RIBEPRIM'))
            ->to('jonathan.delannoy@ribegroupe.com')
            ->subject('TEST MAIL')
   		    ->embed(fopen('images/background.jpg', 'r'), 'imgP')
            ->html($this->render('ItemsSheets/PDF_ItemsSheets.html.twig', ["item"=> $itemSheet, "itemFields" => $ItemFields]));

        $mailer->send($email);

        return $this->redirectToRoute("index");
    }
}