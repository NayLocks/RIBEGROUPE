<?php

namespace App\Controller;

use App\Entity\ItemsSheets;
use App\Entity\User;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use FPDI;
use PDFMerger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

class ItemsSheetsController extends AbstractController
{
    /**
     * @Route("/fiches_articles", name="itemsSheets")
     */
    public function itemsSheets(UserInterface $user): Response
    {
        $allItemsSheets = $this->getDoctrine()->getRepository(ItemsSheets::class);
        $itemsSheets = $allItemsSheets->findAll();
        
        $tab = array();
        foreach($itemsSheets as $e){
            $champs = new SelectSQL();
            $tab[] = $champs->selectSQLItemCode($user->getCompany()->getDatabaseName(), $e);
        }

        if(isset($_POST["TEST"])){
            $row = array();
            foreach (array_keys($_POST) as $key) 
            {
                $$key = $_POST[$key];
                $row[] = explode("_", $key);
            }

            $merger = new PDFMerger();

            foreach($row as $e){
                if($e[0] != "TEST"){
                    $allItemsSheets = $this->getDoctrine()->getRepository(ItemsSheets::class);
                    $itemSheet = $allItemsSheets->findOneBy(array("id" => $e[0]));
                    
                    $champs = new SelectSQL();
                    $ItemFields = $champs->selectSQLItemCode($user->getCompany()->getDatabaseName(), $itemSheet);
                            
                    if(!file_exists('Documents/Fiches_Articles/'.$itemSheet->getId())){
                        mkdir('Documents/Fiches_Articles/'.$itemSheet->getId());
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
                    $pdfFilepath =  'Documents/Fiches_Articles/'.$itemSheet->getId().'/Fiche_Article_'.$itemSheet->getId().'.pdf';
                    $path = 'Fiche_Article_'.$itemSheet->getId().'.pdf';
                    file_put_contents($pdfFilepath, $output);

                }
            }
            //$pdf->merge('download', $this->getParameter('kernel.project_dir')."/public/".'PDF_TEST.pdf');
            //$pdf->merge('file', 'test.pdf');
            /*$merger->addPDF($this->getParameter('kernel.project_dir')."/public/".'Documents/Fiches_Articles/12/Fiche_Article_12.pdf', 'all');
            $merger->merge('browser');*/
            
            exit();
        }


        return $this->render('ItemsSheets/ItemsSheets.html.twig', ["items" => $itemsSheets, 'champs' => $tab]);
    }
    
    /**
     * @Route("/fiches_articles/mes_fiches", name="myItemsSheets")
     */
    public function myItemsSheets(UserInterface $user): Response
    {
        $allItemsSheets = $this->getDoctrine()->getRepository(ItemsSheets::class);
        $itemsSheets = $allItemsSheets->findBy(array("username" => $user), array("dateCreated" => "DESC"));

        $tab = array();
        foreach($itemsSheets as $e){
            $champs = new SelectSQL();
            $tab[] = $champs->selectSQLItemCode($user->getCompany()->getDatabaseName(), $e);
        }

        return $this->render('ItemsSheets/ItemsSheets.html.twig', ["items" => $itemsSheets, 'champs' => $tab]);
    }

    /**
     * @Route("/fiches_articles/creation", name="newItemSheet")
     */
    public function newItemSheet(UserInterface $user, MailerInterface $mailer): Response
    {
        $itemSheet = new ItemsSheets();

        $champs = new SelectSQL();
        $champsList = $champs->selectSQLItemFields($user->getCompany()->getDatabaseName());
        $ItemFields = $champs->selectSQLItemCode($user->getCompany()->getDatabaseName(), $itemSheet);


        if(isset($_POST['ACHETEUR'])){
            $this->SQLItemSheet($user, "CREATION", $itemSheet, $_POST, "COMPTABILITE");

            $this->SendMail($itemSheet, "COMPTABILITE", "NOUVELLE", $mailer);

            return $this->redirectToRoute("newItemSheet");
        }
        
        if(isset($_POST['BROUILLON'])){
            $itemSheet = new ItemsSheets();
            $this->SQLItemSheet($user, "CREATION", $itemSheet, $_POST, "BROUILLON");

            return $this->redirectToRoute("newItemSheet");
        }

        return $this->render('ItemsSheets/Form_ItemsSheets.html.twig', ["item"=> $itemSheet, "groupItem" => $champsList[0], "stat1" => $champsList[1], "stat2" => $champsList[2], "stat3" => $champsList[3], "stat4" => $champsList[4], "noticeAccentuate" => $champsList[5], "localization" => $champsList[6], "rup" => $champsList[7], "siqo" => $champsList[8], "itemFields" => $ItemFields]);
    }

    /**
     * @Route("/fiches_articles/modification/{id}", name="editItemSheet")
     */
    public function editItemSheet(MailerInterface $mailer, UserInterface $user, $id): Response
    {
        $allItemsSheets = $this->getDoctrine()->getRepository(ItemsSheets::class);
        $itemSheet = $allItemsSheets->findOneBy(array("id" => $id));
        
        $champsList = array();

        $champs = new SelectSQL();
        $champsList = $champs->selectSQLItemFields($user->getCompany()->getDatabaseName());

        if(isset($_POST['ACHETEUR'])){
            $this->SQLItemSheet($user, "MODIFICATION", $itemSheet, $_POST, "COMPTABILITE");

            $this->SendMail($itemSheet, "COMPTABILITE", "NOUVELLE", $mailer);

            return $this->redirectToRoute("myItemsSheets");
        }
        
        if(isset($_POST['BROUILLON'])){
            $this->SQLItemSheet($user, "MODIFICATION", $itemSheet, $_POST, "BROUILLON");

            return $this->redirectToRoute("myItemsSheets");
        }

        if($itemSheet->getStep() == "BROUILLON" && $itemSheet->getUsername() == $user){
            $ItemFields = $champs->selectSQLItemCode($user->getCompany()->getDatabaseName(), $itemSheet);
                
            return $this->render('ItemsSheets/Form_ItemsSheets.html.twig', ["item"=> $itemSheet, "groupItem" => $champsList[0], "stat1" => $champsList[1], "stat2" => $champsList[2], "stat3" => $champsList[3], "stat4" => $champsList[4], "noticeAccentuate" => $champsList[5], "localization" => $champsList[6], "rup" => $champsList[7], "siqo" => $champsList[8], "itemFields" => $ItemFields]);
        }
        else if($itemSheet->getStep() == "COMPTABILITE" && $user->getTitleFA() == "COMPTA"){
            $ItemFields = $champs->selectSQLItemCode($user->getCompany()->getDatabaseName(), $itemSheet);
                
            return $this->render('ItemsSheets/Form_ItemsSheets.html.twig', ["item"=> $itemSheet, "groupItem" => $champsList[0], "stat1" => $champsList[1], "stat2" => $champsList[2], "stat3" => $champsList[3], "stat4" => $champsList[4], "noticeAccentuate" => $champsList[5], "localization" => $champsList[6], "rup" => $champsList[7], "siqo" => $champsList[8], "itemFields" => $ItemFields]);
        }
        else{
            return $this->redirectToRoute('itemsSheets');
        }
    }
    
    /**
     * @Route("/fiches_articles/validation/{id}", name="validItemSheet")
     */
    public function validItemSheet(MailerInterface $mailer, UserInterface $user, $id): Response
    {
        $allItemsSheets = $this->getDoctrine()->getRepository(ItemsSheets::class);
        $itemSheet = $allItemsSheets->findOneBy(array("id" => $id));
        
        $champsList = array();

        $champs = new SelectSQL();
        $champsList = $champs->selectSQLItemFields($user->getCompany()->getDatabaseName());



        if(isset($_POST['REFUS'])){
            $this->SQLItemSheet($user, "REFUS", $itemSheet, $_POST, "BROUILLON");

            $this->SendMail($itemSheet, "ACHETEUR", "REFUS", $mailer);

            return $this->redirectToRoute("myItemsSheets");
        }
        
        if(isset($_POST['COMPTABILITE'])){
            $this->SQLItemSheet($user, "MODIFICATION", $itemSheet, $_POST, "TERMINEE");

            $this->SendMail($itemSheet, "ACHETEUR", "VALIDATION", $mailer);

            return $this->redirectToRoute("myItemsSheets");
        }

        

        if($itemSheet->getStep() == "COMPTABILITE" && $user->getTitleFA() == "COMPTA"){
            $ItemFields = $champs->selectSQLItemCode($user->getCompany()->getDatabaseName(), $itemSheet);
                
            return $this->render('ItemsSheets/Form_ItemsSheets.html.twig', ["item"=> $itemSheet, "groupItem" => $champsList[0], "stat1" => $champsList[1], "stat2" => $champsList[2], "stat3" => $champsList[3], "stat4" => $champsList[4], "noticeAccentuate" => $champsList[5], "localization" => $champsList[6], "rup" => $champsList[7], "siqo" => $champsList[8], "itemFields" => $ItemFields]);
        }
        else{
            return $this->redirectToRoute('itemsSheets');
        }
    }

    /**
     * @Route("/fiches_articles/pdf/{id}", name="pdfItemSheet")
     */
    public function pdfItemSheet(UserInterface $user, $id): Response
    {
        $allItemsSheets = $this->getDoctrine()->getRepository(ItemsSheets::class);
        $itemSheet = $allItemsSheets->findOneBy(array("id" => $id));
        
        $champs = new SelectSQL();
        $ItemFields = $champs->selectSQLItemCode($user->getCompany()->getDatabaseName(), $itemSheet);
                
        if(!file_exists('Documents/Fiches_Articles/'.$itemSheet->getId())){
            mkdir('Documents/Fiches_Articles/'.$itemSheet->getId());
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
        $pdfFilepath =  'Documents/Fiches_Articles/'.$itemSheet->getId().'/Fiche_Article_'.$itemSheet->getId().'.pdf';
        $path = 'Fiche_Article_'.$itemSheet->getId().'.pdf';
        file_put_contents($pdfFilepath, $output);
        
        return $this->redirect('/'.$pdfFilepath);
    }




    public function SQLItemSheet($user, $method, $itemSheet, $champs, $step){

        $date = new DateTime();

        if($method == "CREATION"){
            $itemSheet->setcompany($user->getCompany());
            $itemSheet->setUsername($user);
            $itemSheet->setDateCreated($date);
            $itemSheet->setDateLastChange($date);
            if($step == "COMPTABILITE"){
                $itemSheet->setDateReceipt($date);
            }
        }else if($method == "MODIFICATION"){
            $itemSheet->setDateLastChange($date);
            if($step == "COMPTABILITE"){
                $itemSheet->setDateReceipt($date);
                $itemSheet->setDateValidation(null);
                $itemSheet->setUsernameValidation(null);
            }else if($step == "TERMINEE"){
                $itemSheet->setDateValidation($date);
                $itemSheet->setUsernameValidation($user);
                $itemSheet->setCodeArticle($champs['codeArticle']);
                $itemSheet->setCodeSodexo($champs['codeSodexo']);
                $itemSheet->setCodeSXO($champs['codeSXO']);
            }
        }else if($method == "REFUS"){
            $itemSheet->setDateLastChange($date);
            $itemSheet->setDateValidation($date);
            $itemSheet->setUsernameValidation($user);
            $itemSheet->setReasonRefusal($champs['textRefus']);
        }

        $itemSheet->setStep($step);

        $itemSheet->setGeneric($champs['generic']);
        $itemSheet->setVariety($champs['variety']);
        $itemSheet->setBrand($champs['brand']);
        $itemSheet->setOrigin($champs['origin']);
        $itemSheet->setDiameter($champs['diameter']);
        $itemSheet->setPackaging($champs['packaging']);
        $itemSheet->setCategory($champs['category']);
        $itemSheet->setGroupItem($champs['groupItem']);

        $itemSheet->setFishingNameLatin($champs['fishingNameLatin']);
        $itemSheet->setFishingArea($champs['fishingArea']);

        $itemSheet->setStat1($champs['stat1']);
        $itemSheet->setStat2($champs['stat2']);
        $itemSheet->setStat3($champs['stat3']);
        $itemSheet->setStat4($champs['stat4']);

        $itemSheet->setWeightPackaging($champs['weightPackaging']);
        $itemSheet->setWeightVariable($champs['weightVariable']);
        $itemSheet->setUnitPackaging($champs['unitPackaging']);
        $itemSheet->setUnitVariable($champs['unitVariable']);

        if(isset($champs['ddm'])){
            $itemSheet->setDdm(1);
            $itemSheet->setDlc(0);
        }else if(isset($champs['dlc'])){
            $itemSheet->setDdm(0);
            $itemSheet->setDlc(1);
        }
        else{
            $itemSheet->setDdm(0);
            $itemSheet->setDlc(0);
        }
        
        $itemSheet->setDlcDate($champs['dlcDate']);

        $itemSheet->setNoticeAccentuate($champs['noticeAccentuate']);
        $itemSheet->setLocalization($champs['localization']);
        $itemSheet->setRup($champs['rup']);
        $itemSheet->setSiqo($champs['siqo']);

        $itemSheet->setUnitPurchase($champs['unitPurchase']);
        $itemSheet->setUnitSale($champs['unitSale']);
        $itemSheet->setUnitStock($champs['unitStock']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($itemSheet);
        $em->flush();
    }

    /**
     * ENVOI DES MAILS
     */
    public function SendsMail($itemSheet, $step, $reason, MailerInterface $mailer){

        if($step == "COMPTABILITE"){
            $allUsers = $this->getDoctrine()->getRepository(User::class);
            $users = $allUsers->findBy(array("titleFA" => "COMPTA"));
        }else if($step == "ACHETEUR"){
            $allUsers = $this->getDoctrine()->getRepository(User::class);
            $users = $allUsers->findBy(array("username" => $itemSheet->getUsername()->getUsername()));
        }else{
            $allUsers = $this->getDoctrine()->getRepository(User::class);
            $users = $allUsers->findBy(array("username" => "VICP"));
        }


        $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com', 'Fiche Article'))
                    ->subject('Fiche Article : '.$_POST["generic"])
                    ->embed(fopen('images/background.jpg', 'r'), 'imgP')
                    ->html('');

        foreach($users as $u){
            $email->addTo($u->getEmail());
        }

        $mailer->send($email);
    }
}