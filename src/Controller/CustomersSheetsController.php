<?php

namespace App\Controller;

use App\Entity\Companies;
use App\Entity\CustomersSheets;
use App\Entity\Steps;
use App\Entity\User;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class CustomersSheetsController extends AbstractController
{
    /**
     * @Route("/fiches/clients", name="customersSheets")
     */
    public function customersSheets()
    {
        $em = $this->getDoctrine()->getManager();
        $customersSheets = $em->getRepository(CustomersSheets::class)->findAll();
        
        return $this->render('CustomersSheets/CustomersSheets.html.twig', [
            'customersSheets' => $customersSheets,
        ]);
    }

    /**
     * @Route("/fiches/clients/mes_fiches", name="myCustomersSheets")
     */
    public function myCustomersSheets(UserInterface $user): Response
    {
        $em = $this->getDoctrine()->getManager();
        $customersSheets = $em->getRepository(CustomersSheets::class)->findBy(['username' => $user]);

        return $this->render('CustomersSheets/My_CustomersSheets.html.twig', [
            "customersSheets" => $customersSheets,
        ]);
    }

    /**
     * @Route("/fiches/clients/validation_attente", name="validCustomersSheets")
     */
    public function validCustomersSheets(UserInterface $user): Response
    {
        $step = $this->getDoctrine()->getRepository(Steps::class)->findOneBy(['name' => $user->getTitleFC()]);
        
        $em = $this->getDoctrine()->getManager();
        $customersSheets = $em->getRepository(CustomersSheets::class)->findBy(['step' => $step]);

        return $this->render('CustomersSheets/Valid_CustomersSheets.html.twig', [
            "customersSheets" => $customersSheets,
        ]);
    }

    /**
     * @Route("/fiches/clients/visualisation/{id}", name="viewCustomersSheets")
     */
    public function viewCustomersSheets(UserInterface $user, $id): Response
    {
        $customerSheet = $this->getDoctrine()->getRepository(CustomersSheets::class)->findOneBy(array("id" => $id));
    
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
        $pdfFilepath =  'Documents/Fiches_Clients/'.$customerSheet->getId().'/Fiche_Client_'.$customerSheet->getId().'.pdf';
        $path = 'Fiche_Client_'.$customerSheet->getId().'.pdf';
        file_put_contents($pdfFilepath, $output);

        return $this->render('CustomersSheets/View_CustomerSheet.html.twig', ['customerSheet' => $customerSheet]);
    }

    /**
     * @Route("/fiches/clients/modification/{id}", name="editCustomersSheets")
     */
    public function editCustomersSheets(UserInterface $user, MailerInterface $mailer, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $customerSheet = $em->getRepository(CustomersSheets::class)->findOneBy(['id' => $id]);

        $requete = new SelectSQL();
        $champs = $requete->selectSQLCustomer($user->getCompany()->getDatabaseName(), $user->getCompany()->getCodeClient());

        $companies = $this->getDoctrine()->getRepository(Companies::class)->findAll();

        if(isset($_POST['callName'])){
            if(isset($_POST['VALIDATION'])){
                var_dump($_FILES);
                var_dump($_POST);
                exit();
                $this->SQLCustomersSheets($user, $customerSheet, $_POST, "VALIDATION", $mailer);

                
                return $this->redirectToRoute('customersSheets');
            }
        }

        return $this->render('CustomersSheets/Form_CustomerSheet.html.twig', [
            'companies' => $companies,
            'customerSheet' => $customerSheet,
            'stat1' => $champs[0],
            'stat2' => $champs[1],
            'stat3' => $champs[2],
            'stat4' => $champs[3],
            'stat5' => $champs[4],
            'tournees' => $champs[5],
            'commercials' => $champs[6],
            'televendeurs' => $champs[7],
        ]);
    }

    /**
     * @Route("/fiches/clients/creation", name="newCustomerSheet")
     */
    public function newCustomerSheet(UserInterface $user, MailerInterface $mailer): Response
    {
        $customerSheet = new CustomersSheets();

        $requete = new SelectSQL();
        $champs = $requete->selectSQLCustomer($user->getCompany()->getDatabaseName(), $user->getCompany()->getCodeClient());

        $companies = $this->getDoctrine()->getRepository(Companies::class)->findAll();

        if(isset($_POST['callName'])){
            if(isset($_POST['VALIDATION'])){
            $customerSheet = new CustomersSheets();

            $this->SQLCustomersSheets($user, $customerSheet, $_POST, "VALIDATION", $mailer);
            }
        }

        return $this->render('CustomersSheets/Form_CustomerSheet.html.twig', [
            'companies' => $companies,
            'customerSheet' => $customerSheet,
            'stat1' => $champs[0],
            'stat2' => $champs[1],
            'stat3' => $champs[2],
            'stat4' => $champs[3],
            'stat5' => $champs[4],
            'tournees' => $champs[5],
            'commercials' => $champs[6],
            'televendeurs' => $champs[7],
        ]);
    }

    public function SQLCustomersSheets($user, $customerSheet, $var, $method, MailerInterface $mailer){
        $company = $this->getDoctrine()->getRepository(Companies::class)->findOneBy(['name' => $var["company"]]);

        if($method == "VALIDATION"){
            if($var["step"] == "BROUILLON"){
                $step = $this->getDoctrine()->getRepository(Steps::class)->findOneBy(['name' => "LOGISTIQUE"]);
            }else if($var["step"] == "LOGISTIQUE"){
                $step = $this->getDoctrine()->getRepository(Steps::class)->findOneBy(['name' => "DIRECTEUR"]);
            }else if($var["step"] == "DIRECTEUR"){
                $step = $this->getDoctrine()->getRepository(Steps::class)->findOneBy(['name' => "COMPTABILITE"]);
            }else if($var["step"] == "COMPTABILITE"){
                $step = $this->getDoctrine()->getRepository(Steps::class)->findOneBy(['name' => "TERMINEE"]);
            }
        }else{
            $var["step"] = "BROUILLON";
        }
        
        $customerSheet->setStep($step);

        if($var["step"] == "BROUILLON"){
            $customerSheet->setCompany($company);
            $customerSheet->setUsername($user);
            $customerSheet->setDate(new DateTime());

            /*$customerSheet->setDateLogistique(null);
            $customerSheet->setUsernameLogistique(null);
            $customerSheet->setDateValidationDirecteur(null);
            $customerSheet->setUsernameLogistique(null);
            $customerSheet->setDateValidationComptabilite(null);
            $customerSheet->setUsernameLogistique(null);
            $customerSheet->setDateValidationTerminee(null);*/
        }
        else if($var["step"]  == "LOGISTIQUE"){
            /*$customerSheet->setDateLogistique(new DateTime());
            $customerSheet->setUsernameLogistique($user);
            $customerSheet->setDateValidationDirecteur(null);
            $customerSheet->setUsernameDirecteur(null);
            $customerSheet->setDateValidationComptabilite(null);
            $customerSheet->setUsernameComptabilite(null);
            $customerSheet->setDateValidationTerminee(null);*/
        }
        else if($var["step"] == "DIRECTEUR"){
            /*$customerSheet->setDateValidationDirecteur(new DateTime());
            $customerSheet->setUsernameDirecteur($user);
            $customerSheet->setDateValidationComptabilite(null);
            $customerSheet->setUsernameComptabilite(null);
            $customerSheet->setDateValidationTerminee(null);*/
        }
        else if($var["step"] == "COMPTABILITE"){
            /*$customerSheet->setDateValidationComptabilite(new DateTime());
            $customerSheet->setUsernameComptabilitee($user);
            $customerSheet->setDateValidationTerminee(null);*/
        }
        else if($var["step"] == "TERMINEE"){
            /*$customerSheet->setDateValidationTerminee(null);*/
        }

        if(isset($var["accountFL"])){
            $var["accountFL"] = 1;
        }else{
            $var["accountFL"] = 0;
        }

        if(isset($var["account45G"])){
            $var["account45G"] = 1;
        }else{
            $var["account45G"] = 0;
        }

        if(isset($var["accountTide"])){
            $var["accountTide"] = 1;
        }else{
            $var["accountTide"] = 0;
        }

        if(isset($var["accountBOF"])){
            $var["accountBOF"] = 1;
        }else{
            $var["accountBOF"] = 0;
        }

        if(isset($var["customerType"])){
            $var["customerType"] = 1;
        }else{
            $var["customerType"] = 0;
        }

        if(isset($var["phoneStandardTel"])){
            $var["phoneStandardTel"] = 1;
        }else{
            $var["phoneStandardTel"] = 0;
        }

        if(isset($var["phoneMobileTel"])){
            $var["phoneMobileTel"] = 1;
        }else{
            $var["phoneMobileTel"] = 0;
        }

        if(isset($var["callCustomer"])){
            $var["callCustomer"] = 1;
        }else{
            $var["callCustomer"] = 0;
        }

        if(isset($var["callMonday"])){
            $var["callMonday"] = 1;
        }else{
            $var["callMonday"] = 0;
        }

        if(isset($var["callTuesday"])){
            $var["callTuesday"] = 1;
        }else{
            $var["callTuesday"] = 0;
        }

        if(isset($var["callWednesday"])){
            $var["callWednesday"] = 1;
        }else{
            $var["callWednesday"] = 0;
        }

        if(isset($var["callThursday"])){
            $var["callThursday"] = 1;
        }else{
            $var["callThursday"] = 0;
        }

        if(isset($var["callFriday"])){
            $var["callFriday"] = 1;
        }else{
            $var["callFriday"] = 0;
        }

        if(isset($var["callSaturday"])){
            $var["callSaturday"] = 1;
        }else{
            $var["callSaturday"] = 0;
        }

        if(isset($var["autoSendRate"])){
            $var["autoSendRate"] = 1;
        }else{
            $var["autoSendRate"] = 0;
        }

        if(isset($var["pvc"])){
            $var["pvc"] = 1;
        }else{
            $var["pvc"] = 0;
        }
       
        if(isset($var["payAdvanced"])){
            $var["payAdvanced"] = 1;
        }else{
            $var["payAdvanced"] = 0;
        }

        if(isset($var["payBankCheck"])){
            $var["payBankCheck"] = 1;
        }else{
            $var["payBankCheck"] = 0;
        }

        if(isset($var["payPayment"])){
            $var["payPayment"] = 1;
        }else{
            $var["payPayment"] = 0;
        }

        if(isset($var["paySampling"])){
            $var["paySampling"] = 1;
        }else{
            $var["paySampling"] = 0;
        }

        if(isset($var["developmentCosts"])){
            $var["developmentCosts"] = 1;
        }else{
            $var["developmentCosts"] = 0;
        }

        if(isset($var["accountBloc"])){
           $var["accountBloc"] = 1;
        }else{
           $var["accountBloc"] = 0;
        }

        $customerSheet->setOldCustomerCode($var["oldCustomerCode"]);
        $customerSheet->setCustomerCode($var["customerCode"]);
        $customerSheet->setAccountBrother($var["accountBrother"]);

        $customerSheet->setAccountFL($var["accountFL"]);
        $customerSheet->setAccount45G($var["account45G"]);
        $customerSheet->setAccountTide($var["accountTide"]);
        $customerSheet->setAccountBOF($var["accountBOF"]);

        $customerSheet->setCallName($var["callName"]);
        $customerSheet->setCodeManagement($var["codeManagement"]);
        $customerSheet->setSocialReason($var["socialReason"]);
        $customerSheet->setnameAccount($var["nameAccount"]);
        $customerSheet->setDeliveryAddress($var["deliveryAddress"]);
        $customerSheet->setDeliveryAddressZipCode($var["deliveryAddressZipCode"]);
        $customerSheet->setDeliveryAddressCity($var["deliveryAddressCity"]);
        $customerSheet->setSiret($var["siret"]);
        $customerSheet->setSiren($var["siren"]);
        $customerSheet->setTVA($var["tva"]);

        $customerSheet->setCustomerType($var["customerType"]);

        $customerSheet->setCommitmentNumber($var["commitmentNumber"]);
        $customerSheet->setServiceCode($var["serviceCode"]);
        $customerSheet->setInvoiceAddress($var["invoiceAddress"]);
        $customerSheet->setInvoiceAddressZipCode($var["invoiceAddressZipCode"]);
        $customerSheet->setInvoiceAddressCity($var["invoiceAddressCity"]);

        $customerSheet->setStat1($var["stat1"]);
        $customerSheet->setStat2($var["stat2"]);
        $customerSheet->setStat3($var["stat3"]);
        $customerSheet->setStat4($var["stat4"]);
        $customerSheet->setStat5($var["stat5"]);

        $customerSheet->setPhoneStandard($var["phoneStandard"]);
        $customerSheet->setPhoneStandardTel($var["phoneStandardTel"]);
        $customerSheet->setPhoneMobile($var["phoneMobile"]);
        $customerSheet->setPhoneMobileTel($var["phoneMobileTel"]);

        $customerSheet->setMailStandard($var["mailStandard"]);
        $customerSheet->setFaxStandard($var["faxStandard"]);

        $customerSheet->setCallCustomer($var["callCustomer"]);
        $customerSheet->setCallMonday($var["callMonday"]);
        $customerSheet->setCallTuesday($var["callTuesday"]);
        $customerSheet->setCallWednesday($var["callWednesday"]);
        $customerSheet->setCallThursday($var["callThursday"]);
        $customerSheet->setCallFriday($var["callFriday"]);
        $customerSheet->setCallSaturday($var["callSaturday"]);

        $customerSheet->setHoursMonday($var["hoursMonday"]);
        $customerSheet->setHoursTuesday($var["hoursTuesday"]);
        $customerSheet->setHoursWednesday($var["hoursWednesday"]);
        $customerSheet->setHoursThursday($var["hoursThursday"]);
        $customerSheet->setHoursFriday($var["hoursFriday"]);
        $customerSheet->setHoursSaturday($var["hoursSaturday"]);

        $customerSheet->setMailInvoice($var["mailInvoice"]);
        $customerSheet->setCustomerRate($var["customerRate"]);

        $customerSheet->setPayAdvanced($var["payAdvanced"]);
        $customerSheet->setPayBankCheck($var["payBankCheck"]);
        $customerSheet->setPayPayment($var["payPayment"]);
        $customerSheet->setPaySampling($var["paySampling"]);

        $customerSheet->setAutoSendRate($var["autoSendRate"]);
        $customerSheet->setDeliveryDate(new DateTime($var["deliveryDate"]));
        $customerSheet->setPvc($var["pvc"]);       
        $customerSheet->setCoefPVC($var["coefPVC"]);

        
        if (!file_exists("Documents/Fiches_Clients/".$customerSheet->getId())) {
            mkdir("Documents/Fiches_Clients/".$customerSheet->getId());
        }

        if($_FILES['extKBIS']['error'] != 4){
            if(file_exists('Documents/Fiches_Clients/'.$customerSheet->getId().'/KBIS.'.$customerSheet->getExtKBIS())){
                unlink('Documents/Fiches_Clients/'.$customerSheet->getId().'/KBIS.'.$customerSheet->getExtKBIS());
            }
            $filename = $_FILES["extKBIS"]["name"];
            $filesize = $_FILES["extKBIS"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");
            move_uploaded_file($_FILES["extKBIS"]["tmp_name"], "Documents/Fiches_Clients/".$customerSheet->getId()."/KBIS.".$ext);
            echo "Votre fichier a été téléchargé avec succès.";
            $customerSheet->setExtKBIS($ext);
        }

        if($_FILES['ext_cgv']['error'] != 4){
            if(file_exists('Documents/Fiches_Clients/'.$customerSheet->getId().'/CGV.'.$customerSheet->getExtCGV())){
                unlink('Documents/Fiches_Clients/'.$customerSheet->getId().'/CGV.'.$customerSheet->getExtCGV());
            }
            $filename = $_FILES["ext_cgv"]["name"];
            $filesize = $_FILES["ext_cgv"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");
            move_uploaded_file($_FILES["ext_cgv"]["tmp_name"], "Documents/Fiches_Clients/".$customerSheet->getId()."/CGV.".$ext);
            echo "Votre fichier a été téléchargé avec succès.";
            $customerSheet->setExtCGV($ext);
        }    

        if($_FILES['extAUTHPREV']['error'] != 4){
            if(file_exists('Documents/Fiches_Clients/'.$customerSheet->getId().'/Autorisation_Prelevement.'.$customerSheet->getExtAUTHPREV())){
                unlink('Documents/Fiches_Clients/'.$customerSheet->getId().'/Autorisation_Prelevement.'.$customerSheet->getExtAUTHPREV());
            }
            $filename = $_FILES["extAUTHPREV"]["name"];
            $filesize = $_FILES["extAUTHPREV"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");
            move_uploaded_file($_FILES["extAUTHPREV"]["tmp_name"], "Documents/Fiches_Clients/".$customerSheet->getId()."/Autorisation_Prelevement.".$ext);
            echo "Votre fichier a été téléchargé avec succès.";
            $customerSheet->setExtAUTHPREV($ext);
        }

        if($_FILES['extRIB']['error'] != 4){
            if(file_exists('Documents/Fiches_Clients/'.$customerSheet->getId().'/RIB.'.$customerSheet->getExtRIB())){
                unlink('Documents/Fiches_Clients/'.$customerSheet->getId().'/RIB.'.$customerSheet->getExtRIB());
            }
            $filename = $_FILES["extRIB"]["name"];
            $filesize = $_FILES["extRIB"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");
            move_uploaded_file($_FILES["extRIB"]["tmp_name"], "Documents/Fiches_Clients/".$customerSheet->getId()."/RIB.".$ext);
            echo "Votre fichier a été téléchargé avec succès.";
            $customerSheet->setExtRIB($ext);
        }
        
        if($_FILES['extOTHERDOCU']['error'] != 4){
            if(file_exists('Documents/Fiches_Clients/'.$customerSheet->getId().'/Autres_Documents.'.$customerSheet->getExtOTHERDOCU())){
                unlink('Documents/Fiches_Clients/'.$customerSheet->getId().'/Autres_Documents.'.$customerSheet->getExtOTHERDOCU());
            }
            $filename = $_FILES["extOTHERDOCU"]["name"];
            $filesize = $_FILES["extOTHERDOCU"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");
            move_uploaded_file($_FILES["ext_autres"]["tmp_name"], "Documents/Fiches_Clients/".$customerSheet->getId()."/Autres_Documents.".$ext);
            echo "Votre fichier a été téléchargé avec succès.";
            $customerSheet->setExtOTHERDOCU($ext);
        }

        $customerSheet->setCtDirName($var["ctDirName"]);
        $customerSheet->setCtDirPhone($var["ctDirPhone"]);
        $customerSheet->setCtDirMail($var["ctDirMail"]);

        $customerSheet->setCtComptaName($var["ctComptaName"]);
        $customerSheet->setCtComptaPhone($var["ctComptaPhone"]);
        $customerSheet->setCtComptaMail($var["ctComptaMail"]);

        $customerSheet->setCtComName($var["ctComName"]);
        $customerSheet->setCtComPhone($var["ctComPhone"]);
        $customerSheet->setCtComMail($var["ctComMail"]);

        $customerSheet->setCtQuaName($var["ctQuaName"]);
        $customerSheet->setCtQuaPhone($var["ctQuaPhone"]);
        $customerSheet->setCtQuaMail($var["ctQuaMail"]);

        $customerSheet->setCtSecName($var["ctSecName"]);
        $customerSheet->setCtSecPhone($var["ctSecPhone"]);
        $customerSheet->setCtSecMail($var["ctSecMail"]);

        $customerSheet->setTrMonday($var["trMonday"]);
        $customerSheet->setTrTuesday($var["trTuesday"]);
        $customerSheet->setTrWednesday($var["trWednesday"]);
        $customerSheet->setTrThursday($var["trThursday"]);
        $customerSheet->setTrFriday($var["trFriday"]);
        $customerSheet->setTrSaturday($var["trSaturday"]);

        $customerSheet->setRgMonday($var["rgMonday"]);
        $customerSheet->setRgTuesday($var["rgTuesday"]);
        $customerSheet->setRgWednesday($var["rgWednesday"]);
        $customerSheet->setRgThursday($var["rgThursday"]);
        $customerSheet->setRgFriday($var["rgFriday"]);
        $customerSheet->setRgSaturday($var["rgSaturday"]);
        
        $customerSheet->setTimeSlot($var["timeSlot"]);
        $customerSheet->setLatitude($var["latitude"]);
        $customerSheet->setLongitude($var["longitude"]);
        $customerSheet->setTextBP($var["textBP"]);
        $customerSheet->setTextBL($var["textBL"]);

        $customerSheet->setCommercialDirector($var["commercialDirector"]);
        $customerSheet->setCommercialMaster($var["commercialMaster"]);
        $customerSheet->setCommercial($var["commercial"]);
        $customerSheet->setTelemarketer($var["telemarketer"]);

        $customerSheet->setTaux1($var["taux1"]);
        $customerSheet->setTaux2($var["taux2"]);
        $customerSheet->setTaux3($var["taux3"]);

        $customerSheet->setNature1($var["nature1"]);
        $customerSheet->setNature2($var["nature2"]);
        $customerSheet->setNature3($var["nature3"]);

        $customerSheet->setFeeLimit($var["feeLimit"]);
        $customerSheet->setFeeAmount($var["feeAmount"]);

        $customerSheet->setPaymentDeadlines($var["paymentDeadlines"]);

        $customerSheet->setDevelopmentCosts($var["developmentCosts"]);
        $customerSheet->setAccountBloc($var["accountBloc"]);

        $em = $this->getDoctrine()->getManager();
        $em->persist($customerSheet);
        $em->flush();

        if($step->getName() != "BROUILLON"){
            $this->SendMail($customerSheet, $step->getName(), $mailer);
        }
    }

    
    public function SendMail($customerSheet, $step, MailerInterface $mailer){

        if($step == "LOGISTIQUE"){
            $allUsers = $this->getDoctrine()->getRepository(User::class);
            $users = $allUsers->findBy(array("titleFC" => "LOGISTIQUE", "company" => $customerSheet->getCompany()));
        }else if($step == "DIRECTEUR"){
            $allUsers = $this->getDoctrine()->getRepository(User::class);
            $users = $allUsers->findBy(array("titleFC" => "DIRECTEUR", "company" => $customerSheet->getCompany()));
        }else if($step == "COMPTABILITE"){ 
            $allUsers = $this->getDoctrine()->getRepository(User::class);
            $users = $allUsers->findBy(array("titleFC" => "COMPTABILITE"));
        }else{
            $allUsers = $this->getDoctrine()->getRepository(User::class);
            $users = $allUsers->findBy(array("username" => "VICP"));
        }

        $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com'))
                    ->subject('FICHE CLIENT : '.$_POST["callName"])
                    ->embed(fopen('images/background.jpg', 'r'), 'imgP')
                    ->html($this->renderView('CustomersSheets/Mail_CustomerSheet.html.twig', ["users" => $users, "customerSheet" => $customerSheet, 'url' => '/fiches/clients/modification/'.$customerSheet->getId()]));

        foreach($users as $u){
            $email->addTo($u->getEmail());
        }

        if($step == "COMPTABILITE"){
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
            $pdfFilepath =  'Documents/Fiches_Clients/'.$customerSheet->getId().'/Fiche_Client_'.$customerSheet->getId().'.pdf';
            file_put_contents($pdfFilepath, $output);

            if(file_exists($pdfFilepath)){
                $email->attachFromPath($pdfFilepath);
            }
            
            if(file_exists('Documents/Fiches_Clients/'.$customerSheet->getId().'/KBIS.'.$customerSheet->getExtKBIS())){
                $email->attachFromPath('Documents/Fiches_Clients/'.$customerSheet->getId().'/KBIS.'.$customerSheet->getExtKBIS());
            }

            if(file_exists('Documents/Fiches_Clients/'.$customerSheet->getId().'/CGV.'.$customerSheet->getExtCGV())){
                $email->attachFromPath('Documents/Fiches_Clients/'.$customerSheet->getId().'/CGV.'.$customerSheet->getExtCGV());
            }

            if(file_exists('Documents/Fiches_Clients/'.$customerSheet->getId().'/Autorisation_Prelevement.'.$customerSheet->getExtAUTHPREV())){
                $email->attachFromPath('Documents/Fiches_Clients/'.$customerSheet->getId().'/Autorisation_Prelevement.'.$customerSheet->getExtAUTHPREV());
            }

            if(file_exists('Documents/Fiches_Clients/'.$customerSheet->getId().'/RIB.'.$customerSheet->getExtRIB())){
                $email->attachFromPath('Documents/Fiches_Clients/'.$customerSheet->getId().'/RIB.'.$customerSheet->getExtRIB());
            }

            if(file_exists('Documents/Fiches_Clients/'.$customerSheet->getId().'/Autres_Documents.'.$customerSheet->getExtOTHERDOCU())){
                $email->attachFromPath('Documents/Fiches_Clients/'.$customerSheet->getId().'/Autres_Documents.'.$customerSheet->getExtOTHERDOCU());
            }
        }

        var_dump($customerSheet->getExtOTHERDOCU());
        var_dump($email);
        exit();

        $mailer->send($email);

        $userEmail = $this->getDoctrine()->getRepository(User::class)->findOneBy(['username' => $customerSheet->getUsername()->getUsername()]);
        $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com'))
                    ->To(new Address($userEmail->getEmail()))
                    ->subject('FICHE CLIENT : '.$_POST["callName"])
                    ->embed(fopen('images/background.jpg', 'r'), 'imgP')
                    ->html($this->renderView('CustomersSheets/Mail_Info_CustomerSheet.html.twig', ["user" => $userEmail, "customerSheet" => $customerSheet, 'url' => '/fiches/clients/visualisation/'.$customerSheet->getId()]));

        $mailer->send($email);
    }
}