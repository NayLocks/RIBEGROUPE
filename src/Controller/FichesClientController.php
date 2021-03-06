<?php

namespace App\Controller;

use App\Entity\Companies;
use App\Entity\FicheClient;
use App\Entity\User;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;


class FichesClientController extends AbstractController
{
    /**
     * @Route("/fiches_client", name="fichesClient")
     */
    public function clients(Request $request): Response
    {
        $allFichesClient = $this->getDoctrine()->getRepository(FicheClient::class);
        $clients = $allFichesClient->findAll();

        return $this->render('FichesClient/FicheClient.html.twig', ["clients" => $clients]);
    }

    /**
     * @Route("/mes_fiches_client", name="myFicheClient")
     */
    public function Myarticle(Request $request, UserInterface $user): Response
    {
        $allFichesClient = $this->getDoctrine()->getRepository(FicheClient::class);
        $clients = $allFichesClient->findBy(array("username" => $user), array("date" => "DESC"));

        return $this->render('FichesClient/My_FicheClient.html.twig', ["clients" => $clients]);
    }

    /**
     * @Route("/liste_des_fiches_client_en_validation", name="listValidFicheClient")
     */
    public function listValidClient(UserInterface $user, Request $request): Response
    {
        $allFichesClient = $this->getDoctrine()->getRepository(FicheClient::class);
        if($user->getTitleFC() == "LOGISTIQUE"){
            $clients = $allFichesClient->findBy(array("etapeFiche" => $user->getTitleFC(), "companyTransport" => $user->getCompany()->getName()));
        }
        else{
            $clients = $allFichesClient->findBy(array("etapeFiche" => $user->getTitleFC(), "company" => $user->getCompany()));
        }

        return $this->render('FichesClient/List_Valid_FicheClient.html.twig', ["clients" => $clients]);
    }

    /**
     * @Route("/suppresion_fiches_client/{id}", name="deleteFicheClient")
     */
    public function deleteValidClient(Request $request, UserInterface $user, $id): Response
    {
        $allFichesClient = $this->getDoctrine()->getRepository(FicheClient::class);
        $client = $allFichesClient->findOneBy(array("id" => $id));

        if($client->getUsername() == $user && $client->getEtapeFiche() == "BROUILLON"){
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();

            return  $this->render('message.html.twig', ["message" => "La fiche est bien supprim??e", "titleMessage" => "Fiche Supprim??e"]);        
        }
        else{
            return  $this->render('message.html.twig', ["message" => "La fiche n'est pas la votre", "titleMessage" => "Fiche Indisponible"]);
        }
    }

    /**
     * @Route("/nouvelle_fiche_client", name="newFicheClient")
     */
    public function index(UserInterface $user, MailerInterface $mailer)
    {
        $tab = new SelectSQLController();
        $tab = $tab->selectSQLClient($user, $user->getCompany()->getDatabaseName());

        $allCompanies = $this->getDoctrine()->getRepository(Companies::class);
        $companySelect = $allCompanies->findAll();
        
        $tabTournees = new SelectSQLController();
        $tabTournees = $tabTournees->selectSQLTournees($user, $user->getCompany()->getCodeClient(), $user->getCompany()->getDatabaseName());

        if(isset($_POST['nomAppel'])){
            $client = new FicheClient();

            if(isset($_POST['VALID'])){
                if($_POST["companyTransport"] == "PROMER OCEAN" or $_POST["companyTransport"] == "SIDELIS" or $_POST["companyTransport"] == "BIO E'MOI"){
                    if($user->getTitleFC() == "DIRECTEUR"){
                        $client->setEtapefiche("COMPTA");
                        $date = new DateTime("now");
                        $client->setDateValidDirection($date);
                    }
                    else{
                        $client->setEtapefiche("DIRECTEUR");
                        $date = new DateTime("now");
                        $client->setDateReceptionDirecteur($date);
                    }
                }else{
                    $client->setEtapefiche("LOGISTIQUE");
                    $date = new DateTime("now");
                    $client->setDateReceptionLogistique($date);
                }
            }
            else if(isset($_POST['BROUILLON'])) {
                $client->setEtapefiche("BROUILLON");
            }  

            $date = new DateTime("now");
            $client->setDate($date);
            
            if(isset($_POST["fl"])){
                $_POST["fl"] = 1;
            }else{
                $_POST["fl"] = 0;
            }
    
            if(isset($_POST["gamme"])){
                $_POST["gamme"] = 1;
            }else{
                $_POST["gamme"] = 0;
            }
    
            if(isset($_POST["maree"])){
                $_POST["maree"] = 1;
            }else{
                $_POST["maree"] = 0;
            }
    
            if(isset($_POST["bof"])){
                $_POST["bof"] = 1;
            }else{
                $_POST["bof"] = 0;
            }
    
            if(isset($_POST["phoneStandardTel"])){
                $_POST["phoneStandardTel"] = 1;
            }else{
                $_POST["phoneStandardTel"] = 0;
            }
    
            if(isset($_POST["phonePortableTel"])){
                $_POST["phonePortableTel"] = 1;
            }else{
                $_POST["phonePortableTel"] = 0;
            }

            if(isset($_POST["appelLundi"])){
                $_POST["appelLundi"] = 1;
            }else{
                $_POST["appelLundi"] = 0;
            }

            if(isset($_POST["appelMardi"])){
                $_POST["appelMardi"] = 1;
            }else{
                $_POST["appelMardi"] = 0;
            }

            if(isset($_POST["appelMercredi"])){
                $_POST["appelMercredi"] = 1;
            }else{
                $_POST["appelMercredi"] = 0;
            }

            if(isset($_POST["appelJeudi"])){
                $_POST["appelJeudi"] = 1;
            }else{
                $_POST["appelJeudi"] = 0;
            }

            if(isset($_POST["appelVendredi"])){
                $_POST["appelVendredi"] = 1;
            }else{
                $_POST["appelVendredi"] = 0;
            }

            if(isset($_POST["appelSamedi"])){
                $_POST["appelSamedi"] = 1;
            }else{
                $_POST["appelSamedi"] = 0;
            }

            if(isset($_POST["avance"])){
                $_POST["avance"] = 1;
            }else{
                $_POST["avance"] = 0;
            }
    

            if(isset($_POST["cheque"])){
                $_POST["cheque"] = 1;
            }else{
                $_POST["cheque"] = 0;
            }
    

            if(isset($_POST["virement"])){
                $_POST["virement"] = 1;
            }else{
                $_POST["virement"] = 0;
            }
    

            if(isset($_POST["prelevement"])){
                $_POST["prelevement"] = 1;
            }else{
                $_POST["prelevement"] = 0;
            }
            
    
    
            $client->setCompany($user->getCompany());
            $client->setUsername($user);

            $client->setCompteFrere($_POST["compteFrere"]);
            $client->setCodeClient($_POST["codeClient"]);
            $client->setAncienCodeClient($_POST["ancienCodeClient"]);

            $client->setCpFL($_POST["fl"]);
            $client->setCp45G($_POST["gamme"]);
            $client->setCpMaree($_POST["maree"]);
            $client->setCpBOF($_POST["bof"]);

            $client->setNomAppel($_POST["nomAppel"]);
            $client->setCodeGestion($_POST["codeGestion"]);
            $client->setRaisonSocial($_POST["raisonSociale"]);
            $client->setNomGrandCompte($_POST["nomGrandCompte"]);
            $client->setAdrLivraison($_POST["adrLivraison"]);
            $client->setAdrLivCodePostal($_POST["adrLivCodePostal"]);
            $client->setAdrLivVille($_POST["adrLivVille"]);
            $client->setSiret($_POST["siret"]);
            $client->setSiren($_POST["siren"]);
            $client->setTva($_POST["tva"]);

            
            $client->setTypeClient($_POST["typeClient"]);
            $client->setEngagement($_POST["engagement"]);
            $client->setCodeService($_POST["codeService"]);
            $client->setAdrFacture($_POST["adrFacture"]);
            $client->setAdrFacCodePostal($_POST["adrFacCodePostal"]);
            $client->setAdrFacVille($_POST["adrFacVille"]);
            $client->setStat1($_POST["stat1"]);
            $client->setStat2($_POST["stat2"]);
            $client->setStat3($_POST["stat3"]);
            $client->setStat4($_POST["stat4"]);
            $client->setStat5($_POST["stat5"]);

            
            $client->setPhoneStandard($_POST["phoneStandard"]);
            $client->setPhoneStandardTel($_POST["phoneStandardTel"]);
            $client->setPhonePortable($_POST["phonePortable"]);
            $client->setPhonePortableTel($_POST["phonePortableTel"]);

            $client->setFaxStandard($_POST["faxStandard"]);
            $client->setEmailStandard($_POST["emailStandard"]);

            $client->setAppelClient($_POST["appelClient"]);

            $client->setAppelLundi($_POST["appelLundi"]);
            $client->setHoraireLundi($_POST["horaireLundi"]);
            $client->setAppelMardi($_POST["appelMardi"]);
            $client->setHoraireMardi($_POST["horaireMardi"]);
            $client->setAppelMercredi($_POST["appelMercredi"]);
            $client->setHoraireMercredi($_POST["horaireMercredi"]);
            $client->setAppelJeudi($_POST["appelJeudi"]);
            $client->setHoraireJeudi($_POST["horaireJeudi"]);
            $client->setAppelVendredi($_POST["appelVendredi"]);
            $client->setHoraireVendredi($_POST["horaireVendredi"]);
            $client->setAppelSamedi($_POST["appelSamedi"]);
            $client->setHoraireSamedi($_POST["horaireSamedi"]);

            $client->setEmailFacture($_POST["emailFacture"]);
            $client->setTarifClient($_POST["tarifClient"]);
            $client->setEnvoiTarifAuto($_POST["envoiTarifAuto"]);

            $date = new DateTime($_POST["date1Livraison"]);
            $client->setDate1Livraison($date);

            $client->setPvc($_POST["pvc"]);
            $client->setCoefPVC($_POST["coefPVC"]);

            $client->setAvance($_POST["avance"]);
            $client->setCheque($_POST["cheque"]);
            $client->setVirement($_POST["virement"]);
            $client->setPrelevement($_POST["prelevement"]);

            
            $client->setCtDirNom($_POST["ctDirNom"]);
            $client->setCtDirTel($_POST["ctDirTel"]);
            $client->setCtDirMail($_POST["ctDirMail"]);
            
            $client->setCtComptaNom($_POST["ctComptaNom"]);
            $client->setCtComptaTel($_POST["ctComptaTel"]);
            $client->setCtComptaMail($_POST["ctComptaMail"]);
            
            $client->setCtComNom($_POST["ctComNom"]);
            $client->setCtComTel($_POST["ctComTel"]);
            $client->setCtComMail($_POST["ctComMail"]);
            
            $client->setCtQuaNom($_POST["ctQuaNom"]);
            $client->setCtQuaTel($_POST["ctQuaTel"]);
            $client->setCtQuaMail($_POST["ctQuaMail"]);
            
            $client->setCtSecNom($_POST["ctSecNom"]);
            $client->setCtSecTel($_POST["ctSecTel"]);
            $client->setCtSecMail($_POST["ctSecMail"]);

            
            $client->setTrLundi($_POST["trLundi"]);
            $client->setTrMardi($_POST["trMardi"]);
            $client->setTrMercredi($_POST["trMercredi"]);
            $client->setTrJeudi($_POST["trJeudi"]);
            $client->setTrVendredi($_POST["trVendredi"]);
            $client->setTrSamedi($_POST["trSamedi"]);
            
            $client->setRgLundi($_POST["rgLundi"]);
            $client->setRgMardi($_POST["rgMardi"]);
            $client->setRgMercredi($_POST["rgMercredi"]);
            $client->setRgJeudi($_POST["rgJeudi"]);
            $client->setRgVendredi($_POST["rgVendredi"]);
            $client->setRgSamedi($_POST["rgSamedi"]);
            
            $client->setPlageHoraire($_POST["plageHoraire"]);
            $client->setLatitude($_POST["latitude"]);
            $client->setLongitude($_POST["longitude"]);

            $client->setBp($_POST["bp"]);
            $client->setBl($_POST["bl"]);

            
            $client->setDirCom($_POST["dirCom"]);
            $client->setComMaitre($_POST["comMaitre"]);
            $client->setCom($_POST["com"]);
            $client->setTel($_POST["tel"]);

            $client->setTaux1($_POST["taux1"]);
            $client->setTaux2($_POST["taux2"]);
            $client->setTaux3($_POST["taux3"]);

            $client->setNature1($_POST["nature1"]);
            $client->setNature2($_POST["nature2"]);
            $client->setNature3($_POST["nature3"]);

            $client->setLimiteFrais($_POST["limiteFrais"]);
            $client->setMontantFrais($_POST["montantFrais"]);
            $client->setFraisDev($_POST["fraisDev"]);
            $client->setDelaisReg($_POST["delaisReg"]);
            $client->setBlocCompte($_POST["blocCompte"]);
            
            $client->setCompanyTransport($_POST["companyTransport"]);
        
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            mkdir("Documents/FicheClient/".$client->getId());

            // DOCUMENT KBIS
            $filename = $_FILES["ext_kbis"]["name"];
            $filesize = $_FILES["ext_kbis"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
            move_uploaded_file($_FILES["ext_kbis"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/KBIS.".$ext);
            echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
            $client->setExtKbis($ext);

            // DOCUMENT CGV
            $filename = $_FILES["ext_cgv"]["name"];
            $filesize = $_FILES["ext_cgv"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
            move_uploaded_file($_FILES["ext_cgv"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/CGV.".$ext);
            echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
            $client->setExtCgv($ext);

            // DOCUMENT AUTORISATION PRELEVEMENT
            $filename = $_FILES["ext_auth"]["name"];
            $filesize = $_FILES["ext_auth"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
            move_uploaded_file($_FILES["ext_auth"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/AUTH_PREV.".$ext);
            echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
            $client->setExtAuth($ext);

            // DOCUMENT RIB
            $filename = $_FILES["ext_rib"]["name"];
            $filesize = $_FILES["ext_rib"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
            move_uploaded_file($_FILES["ext_rib"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/RIB.".$ext);
            echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
            $client->setExtRib($ext);

            // DOCUMENT AUTRES
            $filename = $_FILES["ext_autres"]["name"];
            $filesize = $_FILES["ext_autres"]["size"];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $maxsize = 10 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
            move_uploaded_file($_FILES["ext_autres"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/AUTRES.".$ext);
            echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
            $client->setExtAutres($ext);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            

            if(isset($_POST['VALID'])){
                $allCompanies = $this->getDoctrine()->getRepository(Companies::class);
                $companyTransport = $allCompanies->findBy(array('name' => $_POST["companyTransport"]));

                $allUsers = $this->getDoctrine()->getRepository(User::class);

                if($_POST["companyTransport"] == "PROMER OCEAN" or $_POST["companyTransport"] == "SIDELIS" or $_POST["companyTransport"] == "BIO E'MOI"){
                    if($user->getTitleFC() == "DIRECTEUR"){
                        $companyTransport = $allCompanies->findBy(array('name' => "RIBEGROUPE"));
                        $users = $allUsers->findBy(array('titleFC' => 'COMPTA', 'accessFC' => '1', 'company' => $companyTransport));
                    }else{
                        $users = $allUsers->findBy(array('titleFC' => 'DIRECTEUR', 'accessFC' => '1', 'company' => $companyTransport));
                    }
                }else{
                    $users = $allUsers->findBy(array('titleFC' => 'LOGISTIQUE', 'accessFC' => '1', 'company' => $companyTransport));
                }                
                
                $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com', 'Fiche Client'))
                    ->subject($client->getEtapeFiche().' : Fiche Client : '.$_POST["nomAppel"])
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
                                                                        '.$client->getEtapeFiche().' Nouvelle Fiche Client
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td  colspan="2" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                        Bonjour, Voici une nouvelle fiche client ?? valider.
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                        Soci??t?? :
                                                                    </td>
                                                                    <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                        '.$user->getCompany()->getName().'
                                                                    </td>
                                                                </tr>   
                                                                <tr>
                                                                    <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                        Utilisateur :
                                                                    </td>
                                                                    <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                    '.$user->getFirstName().' '.$user->getLastName().'
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                        Nom d\'Appel :
                                                                    </td>
                                                                    <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                        '.$_POST["nomAppel"].'
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                        Raison Sociale :
                                                                    </td>
                                                                    <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                    '.$_POST["raisonSociale"].'
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding:0 0 20px;" colspan="2" >
                                                                        <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                                                            <tr>
                                                                                <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#7bb84f">
                                                                                    <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="http://'.$_SERVER['HTTP_HOST'].'/validation_fiches_client/'.$client->getId().'">Acc??der ?? la Fiche</a>
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

                if($_POST["companyTransport"] == "PROMER OCEAN" or $_POST["companyTransport"] == "SIDELIS" or $_POST["companyTransport"] == "BIO E'MOI"){
                    if($user->getTitleFC() == "DIRECTEUR"){
                        return  $this->render('message.html.twig', ["message" => "Le p??le client en est inform??", "titleMessage" => "Fiche Enregistr??e"]);
                    }else{
                        return  $this->render('message.html.twig', ["message" => "La direction en est inform??", "titleMessage" => "Fiche Enregistr??e"]);
                    }
                }else{
                    return  $this->render('message.html.twig', ["message" => "La logistique de ".$_POST["companyTransport"]." en est inform??", "titleMessage" => "Fiche Enregistr??e"]);
                }  
            }else{
                return  $this->render('message.html.twig', ["message" => "La fiche est enregistr??e", "titleMessage" => "Fiche Enregistr??e"]);
            }

        }

        return $this->render('FichesClient/New_FicheClient.html.twig', ["companies" => $companySelect, "stats1" => $tab[0], "stats2" => $tab[1], "stats3" => $tab[2], "stats4" => $tab[3], "stats5" => $tab[4], "commercials" => $tab[5], "televendeurs" => $tab[6], "tournees" => $tabTournees[0]]);
    }

    /**
     * @Route("/modification_fiches_client/{id}", name="editFicheClient")
     */
    public function editArticle(Request $request, UserInterface $user, MailerInterface $mailer, $id): Response
    {
        $allFichesClient = $this->getDoctrine()->getRepository(FicheClient::class);
        $client = $allFichesClient->findOneBy(array("id" => $id));

        $allCompanies = $this->getDoctrine()->getRepository(Companies::class);
        $companySelect = $allCompanies->findAll();

        $tabTournees = new SelectSQLController();
        $tabTournees = $tabTournees->selectSQLTournees($user, $user->getCompany()->getCodeClient(), $user->getCompany()->getDatabaseName());

        if(isset($_POST['nomAppel'])){
           
            if(isset($_POST['VALID'])){
                if($_POST["companyTransport"] == "PROMER OCEAN" or $_POST["companyTransport"] == "SIDELIS" or $_POST["companyTransport"] == "BIO E'MOI"){
                    if($user->getTitleFC() == "DIRECTEUR"){
                        $client->setEtapefiche("COMPTA");
                        $date = new DateTime("now");
                        $client->setDateValidDirecton($date);
                    }
                    else{
                        $client->setEtapefiche("DIRECTEUR");
                        $date = new DateTime("now");
                        $client->setDateReceptionDirecteur($date);
                    }
                }else{
                    $client->setEtapefiche("LOGISTIQUE");
                    $date = new DateTime("now");
                    $client->setDateReceptionLogistique($date);
                }
            }
            else if(isset($_POST['BROUILLON'])) {
                $client->setEtapefiche("BROUILLON");
            } 
            
            if(isset($_POST["fl"])){
                $_POST["fl"] = 1;
            }else{
                $_POST["fl"] = 0;
            }
    
            if(isset($_POST["gamme"])){
                $_POST["gamme"] = 1;
            }else{
                $_POST["gamme"] = 0;
            }
    
            if(isset($_POST["maree"])){
                $_POST["maree"] = 1;
            }else{
                $_POST["maree"] = 0;
            }
    
            if(isset($_POST["bof"])){
                $_POST["bof"] = 1;
            }else{
                $_POST["bof"] = 0;
            }
    
            if(isset($_POST["phoneStandardTel"])){
                $_POST["phoneStandardTel"] = 1;
            }else{
                $_POST["phoneStandardTel"] = 0;
            }
    
            if(isset($_POST["phonePortableTel"])){
                $_POST["phonePortableTel"] = 1;
            }else{
                $_POST["phonePortableTel"] = 0;
            }

            if(isset($_POST["appelLundi"])){
                $_POST["appelLundi"] = 1;
            }else{
                $_POST["appelLundi"] = 0;
            }

            if(isset($_POST["appelMardi"])){
                $_POST["appelMardi"] = 1;
            }else{
                $_POST["appelMardi"] = 0;
            }

            if(isset($_POST["appelMercredi"])){
                $_POST["appelMercredi"] = 1;
            }else{
                $_POST["appelMercredi"] = 0;
            }

            if(isset($_POST["appelJeudi"])){
                $_POST["appelJeudi"] = 1;
            }else{
                $_POST["appelJeudi"] = 0;
            }

            if(isset($_POST["appelVendredi"])){
                $_POST["appelVendredi"] = 1;
            }else{
                $_POST["appelVendredi"] = 0;
            }

            if(isset($_POST["appelSamedi"])){
                $_POST["appelSamedi"] = 1;
            }else{
                $_POST["appelSamedi"] = 0;
            }

            if(isset($_POST["avance"])){
                $_POST["avance"] = 1;
            }else{
                $_POST["avance"] = 0;
            }
    

            if(isset($_POST["cheque"])){
                $_POST["cheque"] = 1;
            }else{
                $_POST["cheque"] = 0;
            }
    

            if(isset($_POST["virement"])){
                $_POST["virement"] = 1;
            }else{
                $_POST["virement"] = 0;
            }
    

            if(isset($_POST["prelevement"])){
                $_POST["prelevement"] = 1;
            }else{
                $_POST["prelevement"] = 0;
            }

            if($_FILES['ext_kbis']['error'] != 4){
                if(file_exists('Documents/FicheClient/'.$client->getId().'/KBIS.'.$client->getExtKbis())){
                    unlink('Documents/FicheClient/'.$client->getId().'/KBIS.'.$client->getExtKbis());
                }
                $filename = $_FILES["ext_kbis"]["name"];
                $filesize = $_FILES["ext_kbis"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $maxsize = 10 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
                move_uploaded_file($_FILES["ext_kbis"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/KBIS.".$ext);
                echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
                $client->setExtKbis($ext);
            }

            if($_FILES['ext_cgv']['error'] != 4){
                if(file_exists('Documents/FicheClient/'.$client->getId().'/CGV.'.$client->getExtCgv())){
                    unlink('Documents/FicheClient/'.$client->getId().'/CGV.'.$client->getExtCgv());
                }
                $filename = $_FILES["ext_cgv"]["name"];
                $filesize = $_FILES["ext_cgv"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $maxsize = 10 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
                move_uploaded_file($_FILES["ext_cgv"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/CGV.".$ext);
                echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
                $client->setExtCgv($ext);
            }

            if($_FILES['ext_auth']['error'] != 4){
                if(file_exists('Documents/FicheClient/'.$client->getId().'/AUTH.'.$client->getExtAuth())){
                    unlink('Documents/FicheClient/'.$client->getId().'/AUTH.'.$client->getExtAuth());
                }
                $filename = $_FILES["ext_auth"]["name"];
                $filesize = $_FILES["ext_auth"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $maxsize = 10 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
                move_uploaded_file($_FILES["ext_auth"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/AUTH_PREV.".$ext);
                echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
                $client->setExtAuth($ext);
            }

            if($_FILES['ext_rib']['error'] != 4){
                if(file_exists('Documents/FicheClient/'.$client->getId().'/RIB.'.$client->getExtRib())){
                    unlink('Documents/FicheClient/'.$client->getId().'/RIB.'.$client->getExtRib());
                }
                $filename = $_FILES["ext_rib"]["name"];
                $filesize = $_FILES["ext_rib"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $maxsize = 10 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
                move_uploaded_file($_FILES["ext_rib"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/RIB.".$ext);
                echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
                $client->setExtRib($ext);
            }
            
            if($_FILES['ext_autres']['error'] != 4){
                if(file_exists('Documents/FicheClient/'.$client->getId().'/AUTRES.'.$client->getExtAutres())){
                    unlink('Documents/FicheClient/'.$client->getId().'/AUTRES.'.$client->getExtAutres());
                }
                $filename = $_FILES["ext_autres"]["name"];
                $filesize = $_FILES["ext_autres"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $maxsize = 10 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
                move_uploaded_file($_FILES["ext_autres"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/AUTRES.".$ext);
                echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
                $client->setExtAutres($ext);
            }
            
    
            $date = new DateTime("now");
            $client->setDate($date);
    
            $client->setCompany($user->getCompany());
            $client->setUsername($user);

            $client->setCompteFrere($_POST["compteFrere"]);
            $client->setCodeClient($_POST["codeClient"]);
            $client->setAncienCodeClient($_POST["ancienCodeClient"]);

            $client->setCpFL($_POST["fl"]);
            $client->setCp45G($_POST["gamme"]);
            $client->setCpMaree($_POST["maree"]);
            $client->setCpBOF($_POST["bof"]);

            $client->setNomAppel($_POST["nomAppel"]);
            $client->setCodeGestion($_POST["codeGestion"]);
            $client->setRaisonSocial($_POST["raisonSociale"]);
            $client->setNomGrandCompte($_POST["nomGrandCompte"]);
            $client->setAdrLivraison($_POST["adrLivraison"]);
            $client->setAdrLivCodePostal($_POST["adrLivCodePostal"]);
            $client->setAdrLivVille($_POST["adrLivVille"]);
            $client->setSiret($_POST["siret"]);
            $client->setSiren($_POST["siren"]);
            $client->setTva($_POST["tva"]);

            
            $client->setTypeClient($_POST["typeClient"]);
            $client->setEngagement($_POST["engagement"]);
            $client->setCodeService($_POST["codeService"]);
            $client->setAdrFacture($_POST["adrFacture"]);
            $client->setAdrFacCodePostal($_POST["adrFacCodePostal"]);
            $client->setAdrFacVille($_POST["adrFacVille"]);
            $client->setStat1($_POST["stat1"]);
            $client->setStat2($_POST["stat2"]);
            $client->setStat3($_POST["stat3"]);
            $client->setStat4($_POST["stat4"]);
            $client->setStat5($_POST["stat5"]);

            
            $client->setPhoneStandard($_POST["phoneStandard"]);
            $client->setPhoneStandardTel($_POST["phoneStandardTel"]);
            $client->setPhonePortable($_POST["phonePortable"]);
            $client->setPhonePortableTel($_POST["phonePortableTel"]);

            $client->setFaxStandard($_POST["faxStandard"]);
            $client->setEmailStandard($_POST["emailStandard"]);

            $client->setAppelClient($_POST["appelClient"]);

            $client->setAppelLundi($_POST["appelLundi"]);
            $client->setHoraireLundi($_POST["horaireLundi"]);
            $client->setAppelMardi($_POST["appelMardi"]);
            $client->setHoraireMardi($_POST["horaireMardi"]);
            $client->setAppelMercredi($_POST["appelMercredi"]);
            $client->setHoraireMercredi($_POST["horaireMercredi"]);
            $client->setAppelJeudi($_POST["appelJeudi"]);
            $client->setHoraireJeudi($_POST["horaireJeudi"]);
            $client->setAppelVendredi($_POST["appelVendredi"]);
            $client->setHoraireVendredi($_POST["horaireVendredi"]);
            $client->setAppelSamedi($_POST["appelSamedi"]);
            $client->setHoraireSamedi($_POST["horaireSamedi"]);

            $client->setEmailFacture($_POST["emailFacture"]);
            $client->setTarifClient($_POST["tarifClient"]);
            $client->setEnvoiTarifAuto($_POST["envoiTarifAuto"]);
            $date = new DateTime($_POST["date1Livraison"]);
            $client->setDate1Livraison($date);
            $client->setPvc($_POST["pvc"]);
            $client->setCoefPVC($_POST["coefPVC"]);

            $client->setAvance($_POST["avance"]);
            $client->setCheque($_POST["cheque"]);
            $client->setVirement($_POST["virement"]);
            $client->setPrelevement($_POST["prelevement"]);

            
            $client->setCtDirNom($_POST["ctDirNom"]);
            $client->setCtDirTel($_POST["ctDirTel"]);
            $client->setCtDirMail($_POST["ctDirMail"]);
            
            $client->setCtComptaNom($_POST["ctComptaNom"]);
            $client->setCtComptaTel($_POST["ctComptaTel"]);
            $client->setCtComptaMail($_POST["ctComptaMail"]);
            
            $client->setCtComNom($_POST["ctComNom"]);
            $client->setCtComTel($_POST["ctComTel"]);
            $client->setCtComMail($_POST["ctComMail"]);
            
            $client->setCtQuaNom($_POST["ctQuaNom"]);
            $client->setCtQuaTel($_POST["ctQuaTel"]);
            $client->setCtQuaMail($_POST["ctQuaMail"]);
            
            $client->setCtSecNom($_POST["ctSecNom"]);
            $client->setCtSecTel($_POST["ctSecTel"]);
            $client->setCtSecMail($_POST["ctSecMail"]);

            
            $client->setTrLundi($_POST["trLundi"]);
            $client->setTrMardi($_POST["trMardi"]);
            $client->setTrMercredi($_POST["trMercredi"]);
            $client->setTrJeudi($_POST["trJeudi"]);
            $client->setTrVendredi($_POST["trVendredi"]);
            $client->setTrSamedi($_POST["trSamedi"]);
            
            $client->setRgLundi($_POST["rgLundi"]);
            $client->setRgMardi($_POST["rgMardi"]);
            $client->setRgMercredi($_POST["rgMercredi"]);
            $client->setRgJeudi($_POST["rgJeudi"]);
            $client->setRgVendredi($_POST["rgVendredi"]);
            $client->setRgSamedi($_POST["rgSamedi"]);
            $client->setPlageHoraire($_POST["plageHoraire"]);
            $client->setLatitude($_POST["latitude"]);
            $client->setLongitude($_POST["longitude"]);

            $client->setBp($_POST["bp"]);
            $client->setBl($_POST["bl"]);

            
            $client->setDirCom($_POST["dirCom"]);
            $client->setComMaitre($_POST["comMaitre"]);
            $client->setCom($_POST["com"]);
            $client->setTel($_POST["tel"]);

            $client->setTaux1($_POST["taux1"]);
            $client->setTaux2($_POST["taux2"]);
            $client->setTaux3($_POST["taux3"]);

            $client->setNature1($_POST["nature1"]);
            $client->setNature2($_POST["nature2"]);
            $client->setNature3($_POST["nature3"]);

            $client->setLimiteFrais($_POST["limiteFrais"]);
            $client->setMontantFrais($_POST["montantFrais"]);
            $client->setFraisDev($_POST["fraisDev"]);
            $client->setDelaisReg($_POST["delaisReg"]);
            $client->setBlocCompte($_POST["blocCompte"]);
            
            $client->setCompanyTransport($_POST["companyTransport"]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            if(isset($_POST['VALID'])){
                $allCompanies = $this->getDoctrine()->getRepository(Companies::class);
                $companyTransport = $allCompanies->findBy(array('name' => $_POST["companyTransport"]));

                $allUsers = $this->getDoctrine()->getRepository(User::class);

                if($_POST["companyTransport"] == "PROMER OCEAN" or $_POST["companyTransport"] == "SIDELIS" or $_POST["companyTransport"] == "BIO E'MOI"){
                    if($user->getTitleFC() == "DIRECTEUR"){
                        $companyTransport = $allCompanies->findBy(array('name' => "RIBEGROUPE"));
                        $users = $allUsers->findBy(array('titleFC' => 'COMPTA', 'accessFC' => '1', 'company' => $companyTransport));
                    }else{
                        $users = $allUsers->findBy(array('titleFC' => 'DIRECTEUR', 'accessFC' => '1', 'company' => $companyTransport));
                    }
                }else{
                    $users = $allUsers->findBy(array('titleFC' => 'LOGISTIQUE', 'accessFC' => '1', 'company' => $companyTransport));
                }  

                $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com', 'Fiche Client'))
                    ->subject($client->getEtapeFiche().' : Fiche Client : '.$_POST["nomAppel"])
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
                                                                     '.$client->getEtapeFiche().' : Nouvelle Fiche Client
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td  colspan="2" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Bonjour, Voici une nouvelle fiche client ?? valider.
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Soci??t?? :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$user->getCompany()->getName().'
                                                                 </td>
                                                             </tr>   
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Utilisateur :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$user->getFirstName().' '.$user->getLastName().'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Nom d\'Appel :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$_POST["nomAppel"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Raison Sociale :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["raisonSociale"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="padding:0 0 20px;" colspan="2" >
                                                                     <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                                                         <tr>
                                                                             <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#7bb84f">
                                                                                 <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="http://'.$_SERVER['HTTP_HOST'].'/validation_fiches_client/'.$client->getId().'">Acc??der ?? la Fiche</a>
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

                if($_POST["companyTransport"] == "PROMER OCEAN" or $_POST["companyTransport"] == "SIDELIS" or $_POST["companyTransport"] == "BIO E'MOI"){
                    if($user->getTitleFC() == "DIRECTEUR"){
                        return  $this->render('message.html.twig', ["message" => "Le p??le client en est inform??", "titleMessage" => "Fiche Enregistr??e"]);
                    }else{
                        return  $this->render('message.html.twig', ["message" => "La direction en est inform??", "titleMessage" => "Fiche Enregistr??e"]);
                    }
                }else{
                    return  $this->render('message.html.twig', ["message" => "La logistique de ".$_POST["companyTransport"]." en est inform??", "titleMessage" => "Fiche Enregistr??e"]);
                }  
            }else{

                return  $this->render('message.html.twig', ["message" => "La fiche est enregistr??e", "titleMessage" => "Fiche Enregistr??e"]);
            }

        }


        if($client->getUsername()->getUsername() == $user->getUsername() && $client->getEtapeFiche() == "BROUILLON"){
            $tab = new SelectSQLController();
            $tab = $tab->selectSQLClient($user, $client->getCompany()->getDatabaseName());

            $tabCode = new SelectSQLController();
            $tabCode = $tabCode->selectSQLClientCode($user, $client->getCompany()->getDatabaseName(), $client);

            if(!isset($tabCode[5]['Libelle_TOURNEE_LU'])){
                $tabCode[5] = array("", "");
            }
            if(!isset($tabCode[6]['Libelle_TOURNEE_MA'])){
                $tabCode[6] = array("", "");
            }
            if(!isset($tabCode[7]['Libelle_TOURNEE_ME'])){
                $tabCode[7] = array("", "");
            }
            if(!isset($tabCode[8]['Libelle_TOURNEE_JE'])){
                $tabCode[8] = array("", "");
            }
            if(!isset($tabCode[9]['Libelle_TOURNEE_VE'])){
                $tabCode[9] = array("", "");
            }
            if(!isset($tabCode[10]['Libelle_TOURNEE_SA'])){
                $tabCode[10] = array("", "");
            }
            if(!isset($tabCode[2]['Libelle_STAT3'])){
                $tabCode[2] = array("", "");
            }
            return $this->render('FichesClient/Edit_FicheClient.html.twig', ["companies" => $companySelect, "stats1" => $tab[0], "stats2" => $tab[1], "stats3" => $tab[2], "stats4" => $tab[3], "stats5" => $tab[4], "commercials" => $tab[5], "televendeurs" => $tab[6], "tournees" => $tabTournees[0], "client" => $client,
            "stat1Code" => $tabCode[0], "stat2Code" => $tabCode[1], "stat3Code" => $tabCode[2], "stat4Code" => $tabCode[3], "stat5Code" => $tabCode[4], "trLundiCode" => $tabCode[5], "trMardiCode" => $tabCode[6], "trMercrediCode" => $tabCode[7], "trJeudiCode" => $tabCode[8], "trVendrediCode" => $tabCode[9], "trSamediCode" => $tabCode[10], "comMaitreCode" => $tabCode[11], "comCode" => $tabCode[12], "telCode" => $tabCode[13]]);
        }else{
            return  $this->render('message.html.twig', ["message" => "La fiche n'est pas en BROUILLON ou alors est n'est pas de cette utilisateur", "titleMessage" => "Fiche Indisponible"]);
        }

    }

    /**
     * @Route("/validation_fiches_client/{id}", name="validFicheClient")
     */
    public function validClient(Request $request, UserInterface $user, MailerInterface $mailer, $id): Response
    {
        $allFichesClient = $this->getDoctrine()->getRepository(FicheClient::class);
        $client = $allFichesClient->findOneBy(array("id" => $id));

        $allCompanies = $this->getDoctrine()->getRepository(Companies::class);
        $companySelect = $allCompanies->findAll();

        $tabTournees = new SelectSQLController();
        $tabTournees = $tabTournees->selectSQLTournees($user, $user->getCompany()->getCodeClient(), $user->getCompany()->getDatabaseName());

        if(isset($_POST['nomAppel'])){
           
            if(isset($_POST['VALID'])){
                if($client->getEtapeFiche() == "LOGISTIQUE"){
                    $client->setEtapeFiche("DIRECTEUR");
                    $date = new DateTime("now");
                    $client->setDateReceptionDirecteur($date);
                }else{
                    $client->setEtapeFiche("COMPTA");
                    $date = new DateTime("now");
                    $client->setDateValidDirection($date);
                }
            }
            else if(isset($_POST['REFUS'])){
                $client->setRaisonRefus($_POST["textRefus"]);
                if($client->getEtapeFiche() == "LOGISTIQUE"){
                    $client->setEtapeFiche("BROUILLON");
                    $client->setDateReceptionDirecteur(null);
                    $client->setDateReceptionLogistique(null);
                    $client->setDateValidDirection(null);

                }else if($client->getEtapeFiche() == "DIRECTEUR"){
                    $client->setEtapeFiche("LOGISTIQUE");
                    $date = new DateTime("now");
                    $client->setDateReceptionLogistique($date);
                    $client->setDateReceptionDirecteur(null);
                    $client->setDateValidDirection(null);
                }
            }  
            
            if(isset($_POST["fl"])){
                $_POST["fl"] = 1;
            }else{
                $_POST["fl"] = 0;
            }
    
            if(isset($_POST["gamme"])){
                $_POST["gamme"] = 1;
            }else{
                $_POST["gamme"] = 0;
            }
    
            if(isset($_POST["maree"])){
                $_POST["maree"] = 1;
            }else{
                $_POST["maree"] = 0;
            }
    
            if(isset($_POST["bof"])){
                $_POST["bof"] = 1;
            }else{
                $_POST["bof"] = 0;
            }
    
            if(isset($_POST["phoneStandardTel"])){
                $_POST["phoneStandardTel"] = 1;
            }else{
                $_POST["phoneStandardTel"] = 0;
            }
    
            if(isset($_POST["phonePortableTel"])){
                $_POST["phonePortableTel"] = 1;
            }else{
                $_POST["phonePortableTel"] = 0;
            }

            if(isset($_POST["appelLundi"])){
                $_POST["appelLundi"] = 1;
            }else{
                $_POST["appelLundi"] = 0;
            }

            if(isset($_POST["appelMardi"])){
                $_POST["appelMardi"] = 1;
            }else{
                $_POST["appelMardi"] = 0;
            }

            if(isset($_POST["appelMercredi"])){
                $_POST["appelMercredi"] = 1;
            }else{
                $_POST["appelMercredi"] = 0;
            }

            if(isset($_POST["appelJeudi"])){
                $_POST["appelJeudi"] = 1;
            }else{
                $_POST["appelJeudi"] = 0;
            }

            if(isset($_POST["appelVendredi"])){
                $_POST["appelVendredi"] = 1;
            }else{
                $_POST["appelVendredi"] = 0;
            }

            if(isset($_POST["appelSamedi"])){
                $_POST["appelSamedi"] = 1;
            }else{
                $_POST["appelSamedi"] = 0;
            }

            if(isset($_POST["avance"])){
                $_POST["avance"] = 1;
            }else{
                $_POST["avance"] = 0;
            }
    

            if(isset($_POST["cheque"])){
                $_POST["cheque"] = 1;
            }else{
                $_POST["cheque"] = 0;
            }
    

            if(isset($_POST["virement"])){
                $_POST["virement"] = 1;
            }else{
                $_POST["virement"] = 0;
            }
    

            if(isset($_POST["prelevement"])){
                $_POST["prelevement"] = 1;
            }else{
                $_POST["prelevement"] = 0;
            }

            if($_FILES['ext_kbis']['error'] != 4){
                if(file_exists('Documents/FicheClient/'.$client->getId().'/KBIS.'.$client->getExtKbis())){
                    unlink('Documents/FicheClient/'.$client->getId().'/KBIS.'.$client->getExtKbis());
                }
                $filename = $_FILES["ext_kbis"]["name"];
                $filesize = $_FILES["ext_kbis"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $maxsize = 10 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
                move_uploaded_file($_FILES["ext_kbis"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/KBIS.".$ext);
                echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
                $client->setExtKbis($ext);
            }

            if($_FILES['ext_cgv']['error'] != 4){
                if(file_exists('Documents/FicheClient/'.$client->getId().'/CGV.'.$client->getExtCgv())){
                    unlink('Documents/FicheClient/'.$client->getId().'/CGV.'.$client->getExtCgv());
                }
                $filename = $_FILES["ext_cgv"]["name"];
                $filesize = $_FILES["ext_cgv"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $maxsize = 10 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
                move_uploaded_file($_FILES["ext_cgv"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/CGV.".$ext);
                echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
                $client->setExtCgv($ext);
            }

            if($_FILES['ext_auth']['error'] != 4){
                if(file_exists('Documents/FicheClient/'.$client->getId().'/AUTH_PREV.'.$client->getExtAuth())){
                    unlink('Documents/FicheClient/'.$client->getId().'/AUTH_PREV.'.$client->getExtAuth());
                }
                $filename = $_FILES["ext_auth"]["name"];
                $filesize = $_FILES["ext_auth"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $maxsize = 10 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
                move_uploaded_file($_FILES["ext_auth"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/AUTH_PREV.".$ext);
                echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
                $client->setExtAuth($ext);
            }

            if($_FILES['ext_rib']['error'] != 4){
                if(file_exists('Documents/FicheClient/'.$client->getId().'/RIB.'.$client->getExtRib())){
                    unlink('Documents/FicheClient/'.$client->getId().'/RIB.'.$client->getExtRib());
                }
                $filename = $_FILES["ext_rib"]["name"];
                $filesize = $_FILES["ext_rib"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $maxsize = 10 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
                move_uploaded_file($_FILES["ext_rib"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/RIB.".$ext);
                echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
                $client->setExtRib($ext);
            }
            
            if($_FILES['ext_autres']['error'] != 4){
                if(file_exists('Documents/FicheClient/'.$client->getId().'/AUTRES.'.$client->getExtAutres())){
                    unlink('Documents/FicheClient/'.$client->getId().'/AUTRES.'.$client->getExtAutres());
                }
                $filename = $_FILES["ext_autres"]["name"];
                $filesize = $_FILES["ext_autres"]["size"];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                $maxsize = 10 * 1024 * 1024;
                if($filesize > $maxsize) die("Error: La taille du fichier est sup??rieure ?? la limite autoris??e.");
                move_uploaded_file($_FILES["ext_autres"]["tmp_name"], "Documents/FicheClient/".$client->getId()."/AUTRES.".$ext);
                echo "Votre fichier a ??t?? t??l??charg?? avec succ??s.";
                $client->setExtAutres($ext);
            }

            $client->setCompteFrere($_POST["compteFrere"]);
            $client->setCodeClient($_POST["codeClient"]);
            $client->setAncienCodeClient($_POST["ancienCodeClient"]);

            $client->setCpFL($_POST["fl"]);
            $client->setCp45G($_POST["gamme"]);
            $client->setCpMaree($_POST["maree"]);
            $client->setCpBOF($_POST["bof"]);

            $client->setNomAppel($_POST["nomAppel"]);
            $client->setCodeGestion($_POST["codeGestion"]);
            $client->setRaisonSocial($_POST["raisonSociale"]);
            $client->setNomGrandCompte($_POST["nomGrandCompte"]);
            $client->setAdrLivraison($_POST["adrLivraison"]);
            $client->setAdrLivCodePostal($_POST["adrLivCodePostal"]);
            $client->setAdrLivVille($_POST["adrLivVille"]);
            $client->setSiret($_POST["siret"]);
            $client->setSiren($_POST["siren"]);
            $client->setTva($_POST["tva"]);

            
            $client->setTypeClient($_POST["typeClient"]);
            $client->setEngagement($_POST["engagement"]);
            $client->setCodeService($_POST["codeService"]);
            $client->setAdrFacture($_POST["adrFacture"]);
            $client->setAdrFacCodePostal($_POST["adrFacCodePostal"]);
            $client->setAdrFacVille($_POST["adrFacVille"]);
            $client->setStat1($_POST["stat1"]);
            $client->setStat2($_POST["stat2"]);
            $client->setStat3($_POST["stat3"]);
            $client->setStat4($_POST["stat4"]);
            $client->setStat5($_POST["stat5"]);

            
            $client->setPhoneStandard($_POST["phoneStandard"]);
            $client->setPhoneStandardTel($_POST["phoneStandardTel"]);
            $client->setPhonePortable($_POST["phonePortable"]);
            $client->setPhonePortableTel($_POST["phonePortableTel"]);

            $client->setFaxStandard($_POST["faxStandard"]);
            $client->setEmailStandard($_POST["emailStandard"]);

            $client->setAppelClient($_POST["appelClient"]);

            $client->setAppelLundi($_POST["appelLundi"]);
            $client->setHoraireLundi($_POST["horaireLundi"]);
            $client->setAppelMardi($_POST["appelMardi"]);
            $client->setHoraireMardi($_POST["horaireMardi"]);
            $client->setAppelMercredi($_POST["appelMercredi"]);
            $client->setHoraireMercredi($_POST["horaireMercredi"]);
            $client->setAppelJeudi($_POST["appelJeudi"]);
            $client->setHoraireJeudi($_POST["horaireJeudi"]);
            $client->setAppelVendredi($_POST["appelVendredi"]);
            $client->setHoraireVendredi($_POST["horaireVendredi"]);
            $client->setAppelSamedi($_POST["appelSamedi"]);
            $client->setHoraireSamedi($_POST["horaireSamedi"]);

            $client->setEmailFacture($_POST["emailFacture"]);
            $client->setTarifClient($_POST["tarifClient"]);
            $client->setEnvoiTarifAuto($_POST["envoiTarifAuto"]);
            $date = new DateTime($_POST["date1Livraison"]);
            $client->setDate1Livraison($date);
            $client->setPvc($_POST["pvc"]);
            $client->setCoefPVC($_POST["coefPVC"]);

            $client->setAvance($_POST["avance"]);
            $client->setCheque($_POST["cheque"]);
            $client->setVirement($_POST["virement"]);
            $client->setPrelevement($_POST["prelevement"]);

            
            $client->setCtDirNom($_POST["ctDirNom"]);
            $client->setCtDirTel($_POST["ctDirTel"]);
            $client->setCtDirMail($_POST["ctDirMail"]);
            
            $client->setCtComptaNom($_POST["ctComptaNom"]);
            $client->setCtComptaTel($_POST["ctComptaTel"]);
            $client->setCtComptaMail($_POST["ctComptaMail"]);
            
            $client->setCtComNom($_POST["ctComNom"]);
            $client->setCtComTel($_POST["ctComTel"]);
            $client->setCtComMail($_POST["ctComMail"]);
            
            $client->setCtQuaNom($_POST["ctQuaNom"]);
            $client->setCtQuaTel($_POST["ctQuaTel"]);
            $client->setCtQuaMail($_POST["ctQuaMail"]);
            
            $client->setCtSecNom($_POST["ctSecNom"]);
            $client->setCtSecTel($_POST["ctSecTel"]);
            $client->setCtSecMail($_POST["ctSecMail"]);

            
            $client->setTrLundi($_POST["trLundi"]);
            $client->setTrMardi($_POST["trMardi"]);
            $client->setTrMercredi($_POST["trMercredi"]);
            $client->setTrJeudi($_POST["trJeudi"]);
            $client->setTrVendredi($_POST["trVendredi"]);
            $client->setTrSamedi($_POST["trSamedi"]);
            
            $client->setRgLundi($_POST["rgLundi"]);
            $client->setRgMardi($_POST["rgMardi"]);
            $client->setRgMercredi($_POST["rgMercredi"]);
            $client->setRgJeudi($_POST["rgJeudi"]);
            $client->setRgVendredi($_POST["rgVendredi"]);
            $client->setRgSamedi($_POST["rgSamedi"]);
            
            $client->setPlageHoraire($_POST["plageHoraire"]);
            $client->setLatitude($_POST["latitude"]);
            $client->setLongitude($_POST["longitude"]);

            $client->setBp($_POST["bp"]);
            $client->setBl($_POST["bl"]);

            
            $client->setDirCom($_POST["dirCom"]);
            $client->setComMaitre($_POST["comMaitre"]);
            $client->setCom($_POST["com"]);
            $client->setTel($_POST["tel"]);

            $client->setTaux1($_POST["taux1"]);
            $client->setTaux2($_POST["taux2"]);
            $client->setTaux3($_POST["taux3"]);

            $client->setNature1($_POST["nature1"]);
            $client->setNature2($_POST["nature2"]);
            $client->setNature3($_POST["nature3"]);

            $client->setLimiteFrais($_POST["limiteFrais"]);
            $client->setMontantFrais($_POST["montantFrais"]);
            $client->setFraisDev($_POST["fraisDev"]);
            $client->setDelaisReg($_POST["delaisReg"]);
            $client->setBlocCompte($_POST["blocCompte"]);
            
            $client->setCompanyTransport($_POST["companyTransport"]);

            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();

            if(isset($_POST['REFUS'])){
                $allCompanies = $this->getDoctrine()->getRepository(Companies::class);
                $companyTransport = $allCompanies->findBy(array('name' => $_POST["companyTransport"]));

                $allUsers = $this->getDoctrine()->getRepository(User::class);

                if($client->getEtapeFiche() == "BROUILLON"){
                    $users = $allUsers->findBy(array('username' => $client->getUsername()->getUsername()));
                } 
                else if($client->getEtapeFiche() == "LOGISTIQUE"){
                    $users = $allUsers->findBy(array('titleFC' => 'LOGISTIQUE', 'accessFC' => '1', 'company' => $companyTransport));
                }

                $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com', 'Fiche Client'))
                    ->subject('Refus : Fiche Client : '.$_POST["nomAppel"])
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
                                                                      Fiche Client Refus??
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td  colspan="2" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Raison : '.$client->getRaisonRefus().'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Soci??t?? :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$user->getCompany()->getName().'
                                                                 </td>
                                                             </tr>   
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Utilisateur :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$client ->getUsername()->getFirstName().' '.$client->getUsername()->getLastName().'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Nom d\'Appel :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$_POST["nomAppel"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Raison Sociale :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["raisonSociale"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="padding:0 0 20px;" colspan="2" >
                                                                     <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                                                         <tr>
                                                                             <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#7bb84f">
                                                                                 <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="http://'.$_SERVER['HTTP_HOST'].'/validation_fiches_client/'.$client->getId().'">Acc??der ?? la Fiche</a>
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
                return  $this->render('message.html.twig', ["message" => "La fiche est retourn??e chez : ".$client->getEtapeFiche(), "titleMessage" => "Fiche Enregistr??e"]);
            
            } 

            if(isset($_POST['VALID'])){
                $allCompanies = $this->getDoctrine()->getRepository(Companies::class);
                $companyTransport = $allCompanies->findBy(array('name' => $_POST["companyTransport"]));

                $allUsers = $this->getDoctrine()->getRepository(User::class);

                
                if($client->getEtapeFiche() == "COMPTA"){
                    $companyTransport = $allCompanies->findBy(array('name' => "RIBEGROUPE"));
                    $users = $allUsers->findBy(array('titleFC' => 'COMPTA', 'accessFC' => '1', 'company' => $companyTransport));
                }else{
                    $users = $allUsers->findBy(array('titleFC' => 'DIRECTEUR', 'accessFC' => '1', 'company' => $client->getCompany()));
                }

                if($client->getEtapeFiche() == "DIRECTEUR"){
                $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com', 'Fiche Client'))
                    ->subject($client->getEtapeFiche().' : Fiche Client : '.$_POST["nomAppel"])
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
                                                                     '.$client->getEtapeFiche().' : Nouvelle Fiche Client
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td  colspan="2" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Bonjour, Voici une nouvelle fiche client ?? valider.
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Soci??t?? :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$client->getCompany()->getName().'
                                                                 </td>
                                                             </tr>   
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Utilisateur :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$client->getUsername()->getFirstName().' '.$client->getUsername()->getLastName().'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Nom d\'Appel :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$_POST["nomAppel"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Raison Sociale :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["raisonSociale"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="padding:0 0 20px;" colspan="2" >
                                                                     <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                                                         <tr>
                                                                             <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#7bb84f">
                                                                                 <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="http://'.$_SERVER['HTTP_HOST'].'/validation_fiches_client/'.$client->getId().'">Acc??der ?? la Fiche</a>
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

            if($client->getEtapeFiche() == "COMPTA"){

                $tab = new SelectSQLController();
            $tab = $tab->selectSQLClient($user, $client->getCompany()->getDatabaseName());

            $tabCode = new SelectSQLController();
            $tabCode = $tabCode->selectSQLClientCode($user, $client->getCompany()->getDatabaseName(), $client);

            if(!isset($tabCode[5]['Libelle_TOURNEE_LU'])){
                $tabCode[5] = array("", "");
            }
            if(!isset($tabCode[6]['Libelle_TOURNEE_MA'])){
                $tabCode[6] = array("", "");
            }
            if(!isset($tabCode[7]['Libelle_TOURNEE_ME'])){
                $tabCode[7] = array("", "");
            }
            if(!isset($tabCode[8]['Libelle_TOURNEE_JE'])){
                $tabCode[8] = array("", "");
            }
            if(!isset($tabCode[9]['Libelle_TOURNEE_VE'])){
                $tabCode[9] = array("", "");
            }
            if(!isset($tabCode[10]['Libelle_TOURNEE_SA'])){
                $tabCode[10] = array("", "");
            }
            if(!isset($tabCode[2]['Libelle_STAT3'])){
                $tabCode[2] = array("", "");
            }
        $pdfOptions = new Options();
        $pdfOptions->set('isHtml5ParserEnabled', 'true');
        $pdfOptions->set('enable_remote', true);
        $dompdf = new Dompdf($pdfOptions);
        $dompdf->setBasePath($this->getParameter('kernel.project_dir')."/public/");
        $html = $this->renderView('FichesClient/GenPDF.html.twig', ["stats1" => $tab[0], "stats2" => $tab[1], "stats3" => $tab[2], "stats4" => $tab[3], "stats5" => $tab[4], "commercials" => $tab[5], "televendeurs" => $tab[6], "tournees" => $tabTournees[0], "fiche" => $client,
        "stat1Code" => $tabCode[0], "stat2Code" => $tabCode[1], "stat3Code" => $tabCode[2], "stat4Code" => $tabCode[3], "stat5Code" => $tabCode[4], "trLundiCode" => $tabCode[5], "trMardiCode" => $tabCode[6], "trMercrediCode" => $tabCode[7], "trJeudiCode" => $tabCode[8], "trVendrediCode" => $tabCode[9], "trSamediCode" => $tabCode[10], "comMaitreCode" => $tabCode[11], "comCode" => $tabCode[12], "telCode" => $tabCode[13]]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $output = $dompdf->output();
        $pdfFilepath =  'Documents/FicheClient/'.$client->getId().'/Fiche_Client_'.$client->getId().'.pdf';
        $path = 'Fiche_Client_'.$client->getId().'.pdf';
        file_put_contents($pdfFilepath, $output);


                $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com', 'Fiche Client'))
                    ->subject($client->getEtapeFiche().' : Fiche Client : '.$_POST["nomAppel"])
                    ->embed(fopen('images/background.jpg', 'r'), 'imgP');
                    
                    if(file_exists($pdfFilepath)){
                        $email->attachFromPath($pdfFilepath);
                    }
                    
                    if(file_exists('Documents/FicheClient/'.$client->getId().'/KBIS.'.$client->getExtKbis())){
                        $email->attachFromPath('Documents/FicheClient/'.$client->getId().'/KBIS.'.$client->getExtKbis());
                    }

                    if(file_exists('Documents/FicheClient/'.$client->getId().'/CGV.'.$client->getExtCgv())){
                        $email->attachFromPath('Documents/FicheClient/'.$client->getId().'/CGV.'.$client->getExtCgv());
                    }

                    if(file_exists('Documents/FicheClient/'.$client->getId().'/AUTH_PREV.'.$client->getExtAuth())){
                        $email->attachFromPath('Documents/FicheClient/'.$client->getId().'/AUTH_PREV.'.$client->getExtAuth());
                    }

                    if(file_exists('Documents/FicheClient/'.$client->getId().'/RIB.'.$client->getExtRib())){
                        $email->attachFromPath('Documents/FicheClient/'.$client->getId().'/RIB.'.$client->getExtRib());
                    }

                    if(file_exists('Documents/FicheClient/'.$client->getId().'/AUTRES.'.$client->getExtAutres())){
                        $email->attachFromPath('Documents/FicheClient/'.$client->getId().'/AUTRES.'.$client->getExtAutres());
                    }

                $email->html('<html xmlns="http://www.w3.org/1999/xhtml">
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
                                                                     '.$client->getEtapeFiche().' : Nouvelle Fiche Client
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td  colspan="2" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Bonjour, Voici une nouvelle fiche client ?? valider.
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Soci??t?? :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$client->getCompany()->getName().'
                                                                 </td>
                                                             </tr>   
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Utilisateur :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$client->getUsername()->getFirstName().' '.$client->getUsername()->getLastName().'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Nom d\'Appel :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$_POST["nomAppel"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Raison Sociale :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["raisonSociale"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="padding:0 0 20px;" colspan="2" >
                                                                     <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                                                         <tr>
                                                                             <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#7bb84f">
                                                                                 <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="http://'.$_SERVER['HTTP_HOST'].'/validation_fiches_client/'.$client->getId().'">Acc??der ?? la Fiche</a>
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

            if($client->getEtapeFiche() == "COMPTA"){
                return  $this->render('message.html.twig', ["message" => "Le p??le client en est inform??", "titleMessage" => "Fiche Enregistr??e"]);
            }else{
                return  $this->render('message.html.twig', ["message" => "La direction en est inform??", "titleMessage" => "Fiche Enregistr??e"]);
            }
        }
    }

        if($client->getEtapeFiche() == $user->getTitleFC()){
            $tab = new SelectSQLController();
            $tab = $tab->selectSQLClient($user, $client->getCompany()->getDatabaseName());

            $tabCode = new SelectSQLController();
            $tabCode = $tabCode->selectSQLClientCode($user, $client->getCompany()->getDatabaseName(), $client);

            if(!isset($tabCode[5]['Libelle_TOURNEE_LU'])){
                $tabCode[5] = array("", "");
            }
            if(!isset($tabCode[6]['Libelle_TOURNEE_MA'])){
                $tabCode[6] = array("", "");
            }
            if(!isset($tabCode[7]['Libelle_TOURNEE_ME'])){
                $tabCode[7] = array("", "");
            }
            if(!isset($tabCode[8]['Libelle_TOURNEE_JE'])){
                $tabCode[8] = array("", "");
            }
            if(!isset($tabCode[9]['Libelle_TOURNEE_VE'])){
                $tabCode[9] = array("", "");
            }
            if(!isset($tabCode[10]['Libelle_TOURNEE_SA'])){
                $tabCode[10] = array("", "");
            }

            if(!isset($tabCode[2]['Libelle_STAT3'])){
                $tabCode[2] = array("", "");
            }

            return $this->render('FichesClient/Edit_FicheClient.html.twig', ["companies" => $companySelect, "stats1" => $tab[0], "stats2" => $tab[1], "stats3" => $tab[2], "stats4" => $tab[3], "stats5" => $tab[4], "commercials" => $tab[5], "televendeurs" => $tab[6], "tournees" => $tabTournees[0], "client" => $client,
            "stat1Code" => $tabCode[0], "stat2Code" => $tabCode[1], "stat3Code" => $tabCode[2], "stat4Code" => $tabCode[3], "stat5Code" => $tabCode[4], "trLundiCode" => $tabCode[5], "trMardiCode" => $tabCode[6], "trMercrediCode" => $tabCode[7], "trJeudiCode" => $tabCode[8], "trVendrediCode" => $tabCode[9], "trSamediCode" => $tabCode[10], "comMaitreCode" => $tabCode[11], "comCode" => $tabCode[12], "telCode" => $tabCode[13]]);
        }else{
            return  $this->redirectToRoute("listValidFicheClient");
        }
    }
}