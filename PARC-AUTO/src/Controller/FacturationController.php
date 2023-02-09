<?php

namespace App\Controller;

use DateTime;
use App\Entity\Facture;
use App\Entity\FactureDet;
use App\Entity\MissionCab;
use App\Entity\TypePrestation;
use App\Entity\RelationMission;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FacturationController extends AbstractController
{
    /**
     * @Route("/facturation", name="app_facturation")
     */
    public function index(Request $request, SessionInterface $session, ManagerRegistry $doctrine): Response
    {
        $factures = $doctrine->getRepository(Facture::class)->findAll();
        $em = $this->getDoctrine()->getManager()->getConnection();
        $site = $session->get('iddossier');
        $mission = $this->getDoctrine()
            ->getRepository(MissionCab::class)
            ->findAll();
        $typePrestation = $this->getDoctrine()
            ->getRepository(TypePrestation::class)
            ->findAll();
        $site_all_requete = "SELECT mc.id as idm ,mc.tarif,mc.date_depart,mc.benificiare,mc.date_depart,mc.date_retour,pd.abreviation as abreviation,mc.heure_depart,mc.nb_personnes,is_initier,is_valider ,mc.statut_id,statut

        FROM `mission_cab` mc inner join p_dossier pd on mc.id_dossier=pd.id inner join status_mission sm on mc.statut_id=sm.id where mc.statut_id=3 ORDER BY mc.id DESC";

        $statement_all = $em->prepare($site_all_requete);
        $resultat_all = $statement_all->executeQuery();
        $sites_all = $resultat_all->fetchAll();


        $site_all_ = "SELECT * FROM `p_dossier` where organisation_id is Null";





        $statement = $em->prepare($site_all_);
        $resultat = $statement->executeQuery();
        $sites = $resultat->fetchAll();


        $allSites = "SELECT * FROM `p_dossier` ";
        $statement = $em->prepare($allSites);
        $resultat = $statement->executeQuery();
        $result = $resultat->fetchAll();

        // dd($result);
        return $this->render('facturation/index.html.twig', [
            'factures' => $factures,
            'typePrestation' => $typePrestation,
            // 'idsite' =>$abrev,

            'mission' => $sites_all,
            'sites' => $sites,
            'allSites' => $result,
        ]);
    }

    /**
     * @Route("/facturer_mission", name="facturer_mission")
     */
    public function facturer_mission(Request $request, ManagerRegistry $doctrine)
    {

        $idsMission = json_decode($request->getContent());

        // dd($idsMission);

        $em = $doctrine->getManager();
        foreach ($idsMission as $key => $idMission) {

            $mtTotal = 0;

            $missions = $doctrine->getRepository(RelationMission::class)->findBy(array("mission_id" => intval($idMission)));

            foreach ($missions as $mission) {

                if ($mission->getPrestationId()->getKilometrage() == 1 && $mission->getMissionId()->getMajNuit() == 1) {

                    $mtTotal += $mission->getPrestationId()->getTarifPrestation() * $mission->getKmDepart() +
                        ($mission->getPrestationId()->getTarifPrestation() * $mission->getKmDepart() * 0.5);
                } else {

                    $mtTotal += $mission->getPrestationId()->getTarifPrestation();
                }
            }


            $dateNow = new \DateTime();
            $year = $dateNow->format('y');

            $facture = new Facture();

            $facture->setDateFacture(new DateTime());
            $facture->setMtTotal($mtTotal);
            $facture->setMission($mission->getMissionId());
            $em->persist($facture);
            $em->flush();

            $codeFacture = "FAC" . sprintf("%05d", $facture->getId()) . "-" . $year . "";

            $facture->setCodeFacture($codeFacture);
            $em->persist($facture);
            $em->flush();

            foreach ($missions as $mission) {
                $factureDet = new FactureDet();

                $factureDet->setFacture($facture);
                $factureDet->setPrestation($mission->getPrestationId());

                $em->persist($factureDet);
                $em->flush();
            }
        }

        return new JsonResponse('Good');
    }



    /**
     * @Route("/facturerPdf/{id}", name="facturerPdf1")
     */
    public function facturerPdf($id, ManagerRegistry $doctrine)
    {
        $mpdf = new \Mpdf\Mpdf();

        $facture = $doctrine->getRepository(facture::class)->find($id);

        $em = $doctrine->getManager()->getConnection();

        $site = "SELECT * FROM `p_dossier` where id =" . $facture->getMission()->getIdDossier();

        $statement = $em->prepare($site);
        $resultat = $statement->executeQuery();
        $site = $resultat->fetch();

        $prestations = $doctrine->getRepository(RelationMission::class)->findBy([
            'mission_id' => $facture->getMission(),
        ]);
        // $benificiare = $doctrine->getRepository(MissionCab::class)->findBy($id);

        // dd($prestations);
        $html = $this->renderView(
            'mpdf/facturerMission.html.twig',
            [
                'facture' => $facture,
                'site' => $site,
                'prestations' => $prestations,

            ]
        );

        $mpdf->WriteHTML($html);
        $mpdf->output();
    }


    /**
     * @Route("/filterFacturation_", name="filter_facturation_")
     */
    public function facturationFilter(Request $request, SessionInterface $session): Response
    {

        $em = $this->getDoctrine()->getManager()->getConnection();
        $site = $request->get('abreviationSite');

        $dateDepart = $request->get('dateDepart');
        $dateFin = $request->get('dateFin');
        // dd($site, $dateDepart, $dateFin);
        $requete = '';
        if (empty($dateDepart)) {
        } else {

            $requete .= "and mc.date_depart>='$dateDepart 00:00:00'";
        }
        if (empty($dateFin)) {
        } else {
            $requete .= "and mc.date_depart<='$dateFin 23:59:59'";
        }
        if (empty($site)) {
        } else {
            $requete .= "and pd.abreviation='$site'";
        }


        $site_all_requete = "SELECT DISTINCT  f.id , mc.id as idm , 
        pd.abreviation , mc.code_mission , mc.ville_mission , f.mt_total , 
        mc.benificiare, mc.date_depart, mc.date_retour, pd.description, mc.heure_depart,
        mc.nb_personnes,is_initier,is_valider ,mc.statut_id,statut,mc.tarif,mc.date_mission
        from mission_cab mc
        inner join facture f on f.mission_id = mc.id
        inner join p_dossier pd on mc.id_dossier=pd.id
        inner join status_mission sm on mc.statut_id=sm.id
        where 1=1  $requete AND is_valider=1 and statut_id=3";
        // dd($site_all_requete);
        $statement_all = $em->prepare($site_all_requete);
        $resultat_all = $statement_all->executeQuery();
        $sites_all = $resultat_all->fetchAll();

        // dd($sites_all);
        $html = $this->render('facturation/filterFacturation.html.twig', [

            'factures' => $sites_all,
        ]);

        return new JsonResponse($html->getContent());
    }


    /**
     * @Route("/facturationTotal", name="facturationTotal")
     */
    public function facturationTotal(ManagerRegistry $doctrine)
    {
        $mpdf = new \Mpdf\Mpdf();
        $em = $doctrine->getManager()->getConnection();
        $sql = "SELECT  fac.id as id_facture ,fac.date_facture,fac.code_facture,pre.name,msn.tarif,msn.ville_mission,fac.mt_total,msn.date_depart,msn.id as id_mission , 
        pre.kilometrage , pre.tarif_prestation, pd.description
        FROM facture fac
        INNER JOIN facture_det det on det.facture_id = fac.id
        INNER JOIN prestation pre on pre.id = det.prestation_id
        INNER JOIN mission_cab msn on msn.id = fac.mission_id
         INNER JOIN p_dossier pd on msn.id_dossier=pd.id";
        $stmt = $doctrine->getManager()->getConnection()->prepare($sql);
        $result = $stmt->executeQuery();
        $factures = $result->fetchAll();

        $allSites = "SELECT * FROM `p_dossier` ";
        $statement = $em->prepare($allSites);
        $resultat = $statement->executeQuery();
        $result1 = $resultat->fetchAll();

        // dd($result1);


        $html = $this->renderView(
            'mpdf/facturerMissiontotal.html .twig',
            [

                'prestations' => $factures,
                'site' => $result1



            ]

        );

        $mpdf->WriteHTML($html);
        $mpdf->output();

        return new JsonResponse('GOOD');
    }

    /**
     * @Route("/facturationDetail", name="facturationDetail")
     */
    public function facturationDetail($id, ManagerRegistry $doctrine)
    {
        $mpdf = new \Mpdf\Mpdf();

        // $facture = $doctrine->getRepository(facture::class)->find($id);

        // $em = $doctrine->getManager()->getConnection();

        // $site = "SELECT * FROM `p_dossier` where id =" . $facture->getMission()->getIdDossier();

        // $statement = $em->prepare($site);
        // $resultat = $statement->executeQuery();
        // $site = $resultat->fetch();

        // $prestations = $doctrine->getRepository(RelationMission::class)->findBy([
        //     'mission_id' => $facture->getMission(),
        // ]);
        $html = $this->renderView(
            'mpdf/facturerMissionDetail.html. twig',
            // [
            //     'facture' => $facture,
            //     'site' => $site,
            //     'prestations' => $prestations,

            // ]
        );

        $mpdf->WriteHTML($html);
        $mpdf->output();
    }

    // requete pour afficher les mission facturees
    // SELECT mission_cab.id,mission_cab.site_id_id,mission_cab.date_mission,facture.mt_total,p_dossier.abreviation
    // FROM `mission_cab` 
    // INNER JOIN facture  ON facture.mission_id=mission_cab.id
    // INNER JOIN p_dossier ON mission_cab.id_dossier=p_dossier.id
    // WHERE p_dossier.id=103

}
