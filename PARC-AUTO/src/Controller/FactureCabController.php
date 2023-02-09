<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Entity\MissionCab;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FactureCabController extends AbstractController
{
    /**
     * @Route("/facture/cab", name="app_facture_cab")
     */
    public function index(): Response
    {
        return $this->render('facture_cab/index.html.twig', [
            'controller_name' => 'FactureCabController',
        ]);
    }

    // /**
    //  * @Route("/facturerMission", name="facturerMission")
    //  */
    // public function facturerMission(Request $request, ManagerRegistry $doctrine)
    // {
    //     // dd($request);
    //     $facture = $request->get('facture');
    //     $mission = $request->get('mission');
    //     $DateFac = $request->get('DateFac');
    //     $codeFac = $request->get('codeFac');




    //     // dd($date2);
    //     // $current_day = $current_day->format('Y-m-d');

    //     $em = $this->getDoctrine()->getManager();
    //     $facture = $em->getRepository(Facture::class)->find($request->get('facture'));
    //     $mission = $em->getRepository(MissionCab::class)->find($request->get('mission'));
    //     $codeFac = $em->getRepository(FactureCab::class)->find($request->get('codeFac'));
    //     // $date = new \DateTime('@' . strtotime('now'));
    //     $DateFac = new \DateTime('@' . strtotime($request->get('DateFac')));

    //     $entityManager = $doctrine->getManager();
    //     $facturer = new FactureCab();
    //     // $facture->setDateFac($dateFac);
    //     $facturer->setFacture($facture);
    //     $facturer->setMission($mission);
    //     $facturer->setDateFac(new \DateTime($request->get('DateFac')));
    //     $facturer->setCodeFac($codeFac);


    //     $entityManager->persist($facturer);
    //     $entityManager->flush();
    //     // $facturer->setNumFact('RUR' . $facture->getId());
    //     $entityManager->flush();


    //     return new JsonResponse($facturer->getId());
    //     return die;
    // }


    // /**
    //  * @Route("/facturerPdf/{id}", name="facturerPdf")
    //  */
    // public function facturerPdf($id)
    // {
    //     $mpdf = new \Mpdf\Mpdf();




    //     $html = $this->renderView(
    //         'mdpf/facturerMission.html.twig'
    //     );

    //     $mpdf->WriteHTML($html);
    //     $mpdf->output();
    // }
}
