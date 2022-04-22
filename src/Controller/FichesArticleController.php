<?php

namespace App\Controller;

use App\Controller\SQL\SQLController;
use App\Entity\article;
use App\Entity\FicheArticle;
use App\Entity\User;
use DateTime;
use DateTimeInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

class FichesArticleController extends AbstractController
{
    /**
     * @Route("/fiches_article", name="ficheArticle")
     */
    public function article(Request $request): Response
    {
        $allFichesArticle = $this->getDoctrine()->getRepository(FicheArticle::class);
        $articles = $allFichesArticle->findAll();

        return $this->render('FichesArticle/FicheArticle.html.twig', ["articles" => $articles]);
    }

    /**
     * @Route("/nouvelle_fiches_article", name="newFicheArticle")
     */
    public function Newarticle(Request $request, UserInterface $user, MailerInterface $mailer): Response
    {
        $tab = new SelectSQLController();
        $tab = $tab->selectSQL($user, $user->getCompany()->getDatabaseName());

        if(isset($_POST['generique'])){
            $article = new FicheArticle();

            $article->setCompany($user->getCompany());
            $article->setUsername($user);

            if(isset($_POST['VALID'])){
                $article->setEtapefiche("COMPTA");
            }
            else if(isset($_POST['BROUILLON'])) {
                $article->setEtapefiche("BROUILLON");
            }

            if(isset($_POST["poids_variable"])){
                $poidsVariable = 1;
            }
            else{
                $poidsVariable = 0;
            }

            if(isset($_POST["piece_variable"])){
                $pieceVariable = 1;
            }
            else{
                $pieceVariable = 0;
            }

            if(isset($_POST["dlc"])){
                $dlc = 1;
            }
            else{
                $dlc = 0;
            }

            $date = new DateTime("now");
            $article->setDate($date);

            $article->setGenerique($_POST["generique"]);
            $article->setEspVar($_POST["esp_var"]);
            $article->setMarque($_POST["marque"]);
            $article->setOrigine($_POST["origine"]);
            $article->setCalibre($_POST["calibre"]);
            $article->setConditionnement($_POST["conditionnement"]);
            $article->setCategorie($_POST["categorie"]);

            $article->setGrpArticle($_POST["grp_art"]);

            $article->setNomLatin($_POST["nom_latin"]);
            $article->setZonePeche($_POST["zone_peche"]);

            $article->setPoidsColis($_POST["poids_colis"]);
            $article->setPoidsColisVariable($poidsVariable);
            $article->setPieceColis($_POST["piece_colis"]);
            $article->setPieceColisVariable($pieceVariable);

            $article->setStat1($_POST["stat1"]);
            $article->setStat2($_POST["stat2"]);
            $article->setStat3($_POST["stat3"]);
            $article->setStat4($_POST["stat4"]);

            $article->setDlc($dlc);
            $article->setDlcJour($_POST["dlc_depart"]);
            
            $article->setUniteAchat($_POST["unite_achat"]);
            $article->setUniteVente($_POST["unite_vente"]);
            $article->setUniteStock($_POST["unite_stock"]);

            $article->setMenVal($_POST["men_val"]);
            $article->setLocalisation($_POST["loc"]);
            $article->setRup($_POST["rup"]);
            $article->setSiqo($_POST["siqo"]);

            $article->setCodeArticle("");
            $article->setCodeSodexo("");
            $article->setCodeSXO("");
            $article->setDateCreated($date);


            if(isset($_POST['VALID'])){
                $article->setEtapefiche("COMPTA");
            }
            else if(isset($_POST['BROUILLON'])) {
                $article->setEtapefiche("BROUILLON");
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            if(isset($_POST['VALID'])){
                $allUsers = $this->getDoctrine()->getRepository(User::class);
                $users = $allUsers->findBy(array('titleFA' => 'COMPTA'));
              
                $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com', 'Fiche Article'))
                    ->subject('Fiche Article : '.$_POST["generique"])
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
                                                                     Nouvelle Fiche Article
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td  colspan="2" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Bonjour, Voici une nouvelle fiche article à valider.
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Société :
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
                                                                     Générique :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$_POST["generique"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Groupe Article :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["grp_art"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="padding:0 0 20px;" colspan="2" >
                                                                     <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                                                         <tr>
                                                                             <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#7bb84f">
                                                                                 <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="http://127.0.0.1:8000/validation_fiches_article/'.$article->getId().'">Accéder à la Fiche</a>
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

            return  $this->render('message.html.twig', ["message" => "Le pôle fournisseur en est informé", "titleMessage" => "Fiche Enregistrée"]);
        }
        
        return $this->render('FichesArticle/New_FicheArticle.html.twig', ["grp_art" => $tab[0], "stat1" => $tab[1], "stat2" => $tab[2], "stat3" => $tab[3], "stat4" => $tab[4], "men_val" => $tab[5], "loc" => $tab[6], "rup" => $tab[7], "siqo" => $tab[8]]);
    }
    
    /**
     * @Route("/mes_fiches_article", name="myFicheArticle")
     */
    public function Myarticle(Request $request, UserInterface $user): Response
    {
        $allFichesArticle = $this->getDoctrine()->getRepository(FicheArticle::class);
        $articles = $allFichesArticle->findBy(array("username" => $user), array("date" => "DESC"));

        return $this->render('FichesArticle/My_FicheArticle.html.twig', ["articles" => $articles]);
    }

    /**
     * @Route("/modification_fiches_article/{id}", name="editFicheArticle")
     */
    public function editarticle(Request $request, UserInterface $user, MailerInterface $mailer, $id): Response
    {
        $allFichesArticle = $this->getDoctrine()->getRepository(FicheArticle::class);
        $article = $allFichesArticle->findOneBy(array("id" => $id));

        if(isset($_POST['generique'])){

            if(isset($_POST["poids_variable"])){
                $poidsVariable = 1;
            }
            else{
                $poidsVariable = 0;
            }

            if(isset($_POST["piece_variable"])){
                $pieceVariable = 1;
            }
            else{
                $pieceVariable = 0;
            }

            if(isset($_POST["dlc"])){
                $dlc = 1;
            }
            else{
                $dlc = 0;
            }

            $date = new DateTime("now");
            $article->setDate($date);

            $article->setGenerique($_POST["generique"]);
            $article->setEspVar($_POST["esp_var"]);
            $article->setMarque($_POST["marque"]);
            $article->setOrigine($_POST["origine"]);
            $article->setCalibre($_POST["calibre"]);
            $article->setConditionnement($_POST["conditionnement"]);
            $article->setCategorie($_POST["categorie"]);

            $article->setGrpArticle($_POST["grp_art"]);

            $article->setNomLatin($_POST["nom_latin"]);
            $article->setZonePeche($_POST["zone_peche"]);

            $article->setPoidsColis($_POST["poids_colis"]);
            $article->setPoidsColisVariable($poidsVariable);
            $article->setPieceColis($_POST["piece_colis"]);
            $article->setPieceColisVariable($pieceVariable);

            $article->setStat1($_POST["stat1"]);
            $article->setStat2($_POST["stat2"]);
            $article->setStat3($_POST["stat3"]);
            $article->setStat4($_POST["stat4"]);

            $article->setDlc($dlc);
            $article->setDlcJour($_POST["dlc_depart"]);
            
            $article->setUniteAchat($_POST["unite_achat"]);
            $article->setUniteVente($_POST["unite_vente"]);
            $article->setUniteStock($_POST["unite_stock"]);

            $article->setMenVal($_POST["men_val"]);
            $article->setLocalisation($_POST["loc"]);
            $article->setRup($_POST["rup"]);
            $article->setSiqo($_POST["siqo"]);

            $article->setCodeArticle("");
            $article->setCodeSodexo("");
            $article->setCodeSXO("");
            $article->setDateCreated($date);

            $article->setEtapefiche("COMPTA");
            

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            if(isset($_POST['VALID'])){
                $allUsers = $this->getDoctrine()->getRepository(User::class);
                $users = $allUsers->findBy(array('titleFA' => 'COMPTA'));
              
                $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com', 'Fiche Article'))
                    ->subject('Fiche Article : '.$_POST["generique"])
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
                                                                     Nouvelle Fiche Article
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td  colspan="2" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Bonjour, Voici une nouvelle fiche article à valider.
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Société :
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
                                                                     Générique :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$_POST["generique"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Groupe Article :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["grp_art"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="padding:0 0 20px;" colspan="2" >
                                                                     <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                                                         <tr>
                                                                             <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#7bb84f">
                                                                                 <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="http://127.0.0.1:8000/validation_fiches_article/'.$article->getId().'">Accéder à la Fiche</a>
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

            return  $this->render('message.html.twig', ["message" => "Le pôle fournisseur en est informé", "titleMessage" => "Fiche Enregistrée"]);
        }


        if($article->getUsername()->getUsername() == $user->getUsername() && $article->getEtapeFiche() == "BROUILLON"){
            $tab = new SelectSQLController();
            $tab = $tab->selectSQL($user, $article->getCompany()->getDatabaseName());

            return $this->render('FichesArticle/Edit_FicheArticle.html.twig', ["grp_art" => $tab[0], "stat1" => $tab[1], "stat2" => $tab[2], "stat3" => $tab[3], "stat4" => $tab[4], "men_val" => $tab[5], "loc" => $tab[6], "rup" => $tab[7], "siqo" => $tab[8], "article" => $article]);
        }else{
            return  $this->render('message.html.twig', ["message" => "La fiche n'est pas en BROUILLON ou alors est n'est pas de cette utilisateur", "titleMessage" => "Fiche Indisponible"]);
        }

    }

    /**
     * @Route("/suppresion_fiches_article/{id}", name="deleteFicheArticle")
     */
    public function deleteValidarticle(Request $request, UserInterface $user, $id): Response
    {
        $allFichesArticle = $this->getDoctrine()->getRepository(FicheArticle::class);
        $article = $allFichesArticle->findOneBy(array("id" => $id));

        if($article->getUsername() == $user && $article->getEtapeFiche() == "BROUILLON"){
            $tab = new SelectSQLController();
            $tab = $tab->selectSQL($user, $article->getCompany()->getDatabaseName());

            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();

            return  $this->render('message.html.twig', ["message" => "La fiche est bien supprimée", "titleMessage" => "Fiche Supprimée"]);        
        }
        else{
            return  $this->render('message.html.twig', ["message" => "La fiche n'est pas la votre", "titleMessage" => "Fiche Indisponible"]);
        }
    }

    /**
     * @Route("/liste_des_fiches_article_en_validation", name="listValidFicheArticle")
     */
    public function listValidarticle(Request $request): Response
    {
        $allFichesArticle = $this->getDoctrine()->getRepository(FicheArticle::class);
        $articles = $allFichesArticle->findBy(array("etapeFiche" => "COMPTA"));

        return $this->render('FichesArticle/List_Valid_FicheArticle.html.twig', ["articles" => $articles]);
    }

    /**
     * @Route("/validation_fiches_article/{id}", name="validFicheArticle")
     */
    public function Validarticle(Request $request, UserInterface $user, MailerInterface $mailer, $id): Response
    {
        $allFichesArticle = $this->getDoctrine()->getRepository(FicheArticle::class);
        $article = $allFichesArticle->findOneBy(array("id" => $id, "etapeFiche" => "COMPTA"));

         if(isset($_POST['generique'])){
            if(isset($_POST['VALID'])){
                $article->setEtapefiche("TERMINER");
            }
            else if(isset($_POST['REFUS'])) {
                $article->setEtapefiche("BROUILLON");
                $article->setTextRefus($_POST["textRefus"]);
            }

            if(isset($_POST["poids_variable"])){
                $poidsVariable = 1;
            }
            else{
                $poidsVariable = 0;
            }

            if(isset($_POST["piece_variable"])){
                $pieceVariable = 1;
            }
            else{
                $pieceVariable = 0;
            }

            if(isset($_POST["dlc"])){
                $dlc = 1;
            }
            else{
                $dlc = 0;
            }

            $date = new DateTime("now");

            $article->setGenerique($_POST["generique"]);
            $article->setEspVar($_POST["esp_var"]);
            $article->setMarque($_POST["marque"]);
            $article->setOrigine($_POST["origine"]);
            $article->setCalibre($_POST["calibre"]);
            $article->setConditionnement($_POST["conditionnement"]);
            $article->setCategorie($_POST["categorie"]);

            $article->setGrpArticle($_POST["grp_art"]);

            $article->setNomLatin($_POST["nom_latin"]);
            $article->setZonePeche($_POST["zone_peche"]);

            $article->setPoidsColis($_POST["poids_colis"]);
            $article->setPoidsColisVariable($poidsVariable);
            $article->setPieceColis($_POST["piece_colis"]);
            $article->setPieceColisVariable($pieceVariable);

            $article->setStat1($_POST["stat1"]);
            $article->setStat2($_POST["stat2"]);
            $article->setStat3($_POST["stat3"]);
            $article->setStat4($_POST["stat4"]);

            $article->setDlc($dlc);
            $article->setDlcJour($_POST["dlc_depart"]);
            
            $article->setUniteAchat($_POST["unite_achat"]);
            $article->setUniteVente($_POST["unite_vente"]);
            $article->setUniteStock($_POST["unite_stock"]);

            $article->setMenVal($_POST["men_val"]);
            $article->setLocalisation($_POST["loc"]);
            $article->setRup($_POST["rup"]);
            $article->setSiqo($_POST["siqo"]);

            if(isset($_POST['VALID'])){
                $article->setCodeArticle($_POST["codeArticle"]);
                $article->setCodeSodexo($_POST["codeSodexo"]);
                $article->setCodeSXO($_POST["codeSXO"]);
            }
            else{
                $article->setCodeArticle("");
                $article->setCodeSodexo("");
                $article->setCodeSXO("");
            }

            $article->setDateCreated($date);

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            if(isset($_POST['VALID'])){              
                $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com', 'Fiche Article'))
                    ->subject('Fiche Article (Validée) : '.$_POST["generique"])
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
                                                                     Votre Fiche Article est Validée
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td  colspan="2" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Bonjour, Voici la confirmation de validation de votre fiche.
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Société :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$article->getCompany()->getName().'
                                                                 </td>
                                                             </tr>   
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Utilisateur :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$article->getUsername()->getFirstName().' '.$article->getUsername()->getLastName().'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Générique :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$_POST["generique"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Groupe Article :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["grp_art"].'
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
                                                                                 <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="http://127.0.0.1:8000/modification_fiches_article/'.$article->getId().'">Accéder à la Fiche</a>
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

                $email->addTo($article->getUsername()->getEmail());
                $mailer->send($email);
            }
            if(isset($_POST['REFUS'])){              
                $email = (new Email())
                    ->from(new Address('fax_mail@ribegroupe.com', 'Fiche Article'))
                    ->subject('Fiche Article (Refusée) : '.$_POST["generique"])
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
                                                                     Votre Fiche Article est Refusée
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td  colspan="2" data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Bonjour, Voici la confirmation de refus de votre fiche.
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Société :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$article->getCompany()->getName().'
                                                                 </td>
                                                             </tr>   
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Utilisateur :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$article->getUsername()->getFirstName().' '.$article->getUsername()->getLastName().'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Générique :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     '.$_POST["generique"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Groupe Article :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["grp_art"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                     Raison du Refus :
                                                                 </td>
                                                                 <td data-color="text" data-size="size text" data-min="10" data-max="26" data-link-color="link text color" data-link-style="font-weight:bold; text-decoration:underline; color:#40aceb;" align="center" style="font:bold 16px/25px Arial, Helvetica, sans-serif; color:#888; padding:0 0 23px;">
                                                                 '.$_POST["textRefus"].'
                                                                 </td>
                                                             </tr>
                                                             <tr>
                                                                 <td style="padding:0 0 20px;" colspan="2" >
                                                                     <table width="134" align="center" style="margin:0 auto;" cellpadding="0" cellspacing="0">
                                                                         <tr>
                                                                             <td data-bgcolor="bg-button" data-size="size button" data-min="10" data-max="16" class="btn" align="center" style="font:12px/14px Arial, Helvetica, sans-serif; color:#f8f9fb; text-transform:uppercase; mso-padding-alt:12px 10px 10px; border-radius:2px;" bgcolor="#7bb84f">
                                                                                 <a target="_blank" style="text-decoration:none; color:#f8f9fb; display:block; padding:12px 10px 10px;" href="http://127.0.0.1:8000/modification_fiches_article/'.$article->getId().'">Accéder à la Fiche</a>
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

                $email->addTo($article->getUsername()->getEmail());
                $mailer->send($email);
            }
            
            if(isset($_POST['VALID'])){
                return  $this->render('message.html.twig', ["message" => "La personne est informé de la validation de sa fiche", "titleMessage" => "Fiche Validée"]);
            }
            if(isset($_POST['REFUS'])){
                return  $this->render('message.html.twig', ["message" => "La personne est informé du refus de sa fiche", "titleMessage" => "Fiche Refusée"]);
            }

        }
         
        if($user->getTitleFA() == "COMPTA" && $article->getEtapeFiche() == "COMPTA"){
            $tab = new SelectSQLController();
            $tab = $tab->selectSQL($user, $article->getCompany()->getDatabaseName());

            return $this->render('FichesArticle/Valid_FicheArticle.html.twig', ["grp_art" => $tab[0], "stat1" => $tab[1], "stat2" => $tab[2], "stat3" => $tab[3], "stat4" => $tab[4], "men_val" => $tab[5], "loc" => $tab[6], "rup" => $tab[7], "siqo" => $tab[8], "article" => $article]);
        }
        else{
            return  $this->render('message.html.twig', ["message" => "La fiche n'est pas en COMPTA ou alors vous n'avez pas les droits", "titleMessage" => "Fiche Indisponible"]);
        }
    }
}