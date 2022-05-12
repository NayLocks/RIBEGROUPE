<?php

namespace App\Controller;

use App\Entity\FicheClient;
use Dompdf\Dompdf;
use Dompdf\Options;
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

    /**
     * @Route("/1", name="index21")
     */
    public function index2(UserInterface $user)
    {
        $allClients = $this->getDoctrine()->getRepository(FicheClient::class);
        $client = $allClients->findOneBy(array('id' => 45));

        $tab = new SelectSQLController();
        $tab = $tab->selectSQLClient($user, $client->getCompany()->getDatabaseName());

        $tabCode = new SelectSQLController();
        $tabCode = $tabCode->selectSQLClientCode($user, $client->getCompany()->getDatabaseName(), $client);

        $tabTournees = new SelectSQLController();
        $tabTournees = $tabTournees->selectSQLTournees($user, $user->getCompany()->getCodeClient(), $user->getCompany()->getDatabaseName());

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
        
        return $this->redirect('/'.$pdfFilepath);
    }
}