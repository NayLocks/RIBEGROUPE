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

    public function SendMail($itemSheet, $step, $reason, MailerInterface $mailer){

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
                    ->html('<html xmlns="http://www.w3.org/1999/xhtml">
                 <head>
                     <title>Internal_email-29</title>
                     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                     <style type="text/css">
                         * {
                             -ms-text-size-adjust:100%;
                             -webkit-text-size-adjust:none;
                             -webkit-text-resize:100%;
                             text-resize:100%;
                         }
                         a{
                             outline:none;
                             color:#40aceb;
                             text-decoration:underline;
                         }
                         a:hover{text-decoration:none !important;}
                         .nav a:hover{text-decoration:underline !important;}
                         .title a:hover{text-decoration:underline !important;}
                         .title-2 a:hover{text-decoration:underline !important;}
                         .btn:hover{opacity:0.8;}
                         .btn a:hover{text-decoration:none !important;}
                         .btn{
                             -webkit-transition:all 0.3s ease;
                             -moz-transition:all 0.3s ease;
                             -ms-transition:all 0.3s ease;
                             transition:all 0.3s ease;
                         }
                         table td {border-collapse: collapse !important;}
                         .ExternalClass, .ExternalClass a, .ExternalClass span, .ExternalClass b, .ExternalClass br, .ExternalClass p, .ExternalClass div{line-height:inherit;}
                         @media only screen and (max-width:500px) {
                             table[class="flexible"]{width:100% !important;}
                             table[class="center"]{
                                 float:none !important;
                                 margin:0 auto !important;
                             }
                             *[class="hide"]{
                                 display:none !important;
                                 width:0 !important;
                                 height:0 !important;
                                 padding:0 !important;
                                 font-size:0 !important;
                                 line-height:0 !important;
                             }
                             td[class="img-flex"] img{
                                 width:100% !important;
                                 height:auto !important;
                             }
                             td[class="aligncenter"]{text-align:center !important;}
                             th[class="flex"]{
                                 display:block !important;
                                 width:100% !important;
                             }
                             td[class="wrapper"]{padding:0 !important;}
                             td[class="holder"]{padding:30px 15px 20px !important;}
                             td[class="nav"]{
                                 padding:20px 0 0 !important;
                                 text-align:center !important;
                             }
                             td[class="h-auto"]{height:auto !important;}
                             td[class="description"]{padding:30px 20px !important;}
                             td[class="i-120"] img{
                                 width:120px !important;
                                 height:auto !important;
                             }
                             td[class="footer"]{padding:5px 20px 20px !important;}
                             td[class="footer"] td[class="aligncenter"]{
                                 line-height:25px !important;
                                 padding:20px 0 0 !important;
                             }
                             tr[class="table-holder"]{
                                 display:table !important;
                                 width:100% !important;
                             }
                             th[class="thead"]{display:table-header-group !important; width:100% !important;}
                             th[class="tfoot"]{display:table-footer-group !important; width:100% !important;}
                         }
                     </style>
                 </head>
                 <body style="margin:0; padding:0;" bgcolor="#eaeced">
                     <table style="min-width:320px;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#eaeced">
                         <tr>
                             <td class="wrapper" style="padding:0 10px;">
                                 <table data-module="module-2" data-thumb="thumbnails/02.png" width="100%" cellpadding="0" cellspacing="0">
                                     <tr>
                                         <td data-bgcolor="bg-module" bgcolor="#eaeced">
                                             <table class="flexible" width="600" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                                 <tr>
                                                     <td class="img-flex"><img src="cid:imgP" style="vertical-align:top;" width="600" height="306" alt="" /></td>
                                                 </tr>
                                                 <tr>
                                                     <td data-bgcolor="bg-block" class="holder" style="padding:58px 60px 52px;" bgcolor="#f9f9f9">
                                                         <table width="100%" cellpadding="0" cellspacing="0">
                                                             <tr>
                                                                 <td colspan="2" data-color="title" data-size="size title" data-min="25" data-max="45" data-link-color="link title color" data-link-style="text-decoration:none; color:#292c34;" class="title" align="center" style="font:35px/38px Arial, Helvetica, sans-serif; color:#292c34; padding:0 0 24px;">
                                                                     '.$reason.' : Fiche Article
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td  colspan="2" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Bonjour, Voici les informations de la fiche
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td  colspan="2" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Si Refus, La raison : '.$_POST["textRefus"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Société :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$itemSheet->getCompany()->getName().'
                                                                 </td>
                                                             </tr>   
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Utilisateur :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$itemSheet->getUsername()->getFirstName().' '.$itemSheet->getUsername()->getLastName().'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Générique :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$_POST["generic"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Groupe Article :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["groupItem"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Code Article :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["codeArticle"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Code Sodexo :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["codeSodexo"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Code SXO :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["codeSXO"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="padding:0 0 20px;" colspan="2" >
                                                                     <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                                                         <tr>
                                                                             <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#7bb84f">
                                                                                 <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="http://'.$_SERVER['HTTP_HOST'].'/fiches_articles/validation/'.$itemSheet->getId().'">Accéder à la Fiche</a>
                                                                             </td>
                                                                         </tr>
                                                                     </table>
                                                                 </td>
                                                             </tr>
                                                         </table>
                                                     </td>
                                                 </tr>
                                                 <tr><td height="28"></td></tr>
                                             </table>
                                         </td>
                                     </tr>
                                 </table>
                             </td>
                         </tr>
                     </table>
                 </body>
             </html>');

        foreach($users as $u){
            $email->addTo($u->getEmail());
        }

        $mailer->send($email);
    }
}