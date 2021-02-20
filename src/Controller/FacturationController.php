<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\TriFacture;
use App\Form\TriFactureType;
use App\Repository\FactureRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FacturationController extends AbstractController
{
    /**
     * @Route("/facturation", name="facturation")
     */
    public function index(Request $request,FactureRepository $factureRepository): Response
    {
        
        $triFacture = new TriFacture();
        $form = $this->createForm(TriFactureType::class,$triFacture);
        $form->handleRequest($request);

        // $factures = $factureRepository->findBy(['client'=>'3']);
        // $factures = $factureRepository->findAll();
        $factures = $factureRepository->triFacture($triFacture);

        return $this->render('facturation/index.html.twig', [
            'form' => $form->createView(),
            'factures' => $factures
        ]);
    }

    /**
     * @Route("/facturation-materiel", name="facturation_materiel")
     */
    public function facturation(Request $request)
    {
        $triFacture = new TriFacture();
        // $factures = $clientRepository->facture($triFacture);

        // On définit l'option du pdf
        $pdfOptions = new Options();

        $pdfOptions->set('defaultFont','Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);

        $dompdf->setHttpContext($context);

        $html = $this->renderView('facturation/teste.html.twig',[
            // 'factures' => $factures
        ]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();

        $fichier = 'a.pdf';
        $dompdf->stream($fichier,['Attachement'=>true]);

        // return $this->render('facturation/index.html.twig', [
        //     // 'factures' => $clientRepository->facture($triFacture),
        //     'form' => $form->createView(),
        //     'factures' => $factures
        // ]);
    }
}
