<?php

namespace App\Controller;

use App\Entity\MissionCab;
use App\Entity\TypePrestation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use PhpOffice\PhpSpreadsheet\IOFactory;

class FacturerController extends AbstractController
{
    /**
     * @Route("/facturer", name="app_facturer")
     */
    public function index(Request $request, SessionInterface $session): Response
    {

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


        return $this->render('mission/facturer.html.twig', [
            'typePrestation' => $typePrestation,
            // 'idsite' =>$abrev,

            'mission' => $sites_all,
            'sites' => $sites,
        ]);
    }

    /**
     * @Route("/detailmission/{id}", name="detailmission")
     */
    public function detailmission(Request $request, SessionInterface $session, $id): Response
    {

        $em = $this->getDoctrine()->getManager()->getConnection();
        $myArray = [];

        $mission_to_edit = "SELECT mission_cab.id as id, p_dossier.abreviation,mission_cab.benificiare,mission_cab.nb_personnes,mission_cab.ville_mission
        ,mission_cab.telephone,mission_cab.adress_mission,mission_cab.date_depart,mission_cab.date_retour,mission_cab.heure_depart,mission_cab.maj_nuit,mission_cab.maj_weekend
         FROM `mission_cab`
         INNER JOIN p_dossier ON p_dossier.id=mission_cab.id_dossier WHERE mission_cab.id=$id";
        $statement = $em->prepare($mission_to_edit);
        $resultat = $statement->executeQuery();
        $mission = $resultat->fetchAll();

        $sites = "SELECT prestation.name as nam,type_prestation.designation,type_vehicule.designation as veh,relation_mission.prestation_id_id,relation_mission.id,
                   relation_mission.km_depart as km,relation_mission.jawaz as jawaz,relation_mission.nbrj as nbrj,relation_mission.remise,relation_mission.carburant,mission_cab.maj_weekend,mission_cab.maj_nuit
         FROM `mission_cab`
         INNER JOIN relation_mission  ON relation_mission.mission_id_id=mission_cab.id
         INNER JOIN prestation        ON prestation.id=relation_mission.prestation_id_id
         INNER JOIN type_prestation   ON type_prestation.id=prestation.type_prestation_id
         INNER JOIN type_vehicule     ON prestation.type_vehicule_id=type_vehicule.id
         WHERE mission_cab.id=$id";
        $statement_site = $em->prepare($sites);
        $resultat_site = $statement_site->executeQuery();
        $all_sites = $resultat_site->fetchAll();

        $prestations = "SELECT * FROM `prestation`";
        $statement_pres = $em->prepare($prestations);
        $resultat_pres = $statement_pres->executeQuery();
        $all_presta = $resultat_pres->fetchAll();
        foreach ($all_sites as $item => $value) {

            foreach ($all_presta as $iteme => $valu) {

                if (empty($value['nbrj'])) {

                    $nbrj = 1;
                } else {
                    $nbrj = $value['nbrj'];
                }



                if ($valu['id'] == $value['prestation_id_id']) {
                    //test kilometrage

                    if ($valu['kilometrage'] == 1) {

                        $tarif_first = $value['km'] * $valu['tarif_prestation'];
                        $frais_gestion = ($value['jawaz'] + $value['carburant']) * 0.02;

                        $remise = $value['remise'];



                        if ($value['maj_weekend'] == 1 and $value['maj_nuit'] == 1) {
                            $tarif_maj = ($tarif_first * 50) / 100;
                            // dd($value['jawaz']);


                        } elseif ($value['maj_weekend'] == 1) {
                            $tarif_maj = ($tarif_first * 25) / 100;
                        } elseif ($value['maj_nuit'] == 1) {
                            $tarif_maj = ($tarif_first * 50) / 100;
                        } else {
                            $tarif_maj = 0;
                        }
                        $tarif = ($tarif_first * $nbrj) + $tarif_maj + $frais_gestion + $remise + $value['jawaz'] + $value['carburant'];


                        array_push($myArray, (object)[
                            'id' => $value['id'],
                            'tarif' => $tarif,
                            'tarif_prestation' => $valu['tarif_prestation'],
                            'tarif_first' => $tarif_first,
                            'tarif_maj' => $tarif_maj,
                            'frais_gestion' => $frais_gestion,
                            'remise' => $remise,
                            'jawaz' => $value['jawaz'],
                            'carburant' => $value['carburant'],

                        ]);
                    } else {
                        $tarif_first = $valu['tarif_prestation'];
                        $remise = $value['remise'];
                        $frais_gestion = ($value['jawaz'] + $value['carburant']) * 0.02;

                        if ($value['maj_weekend'] == 1 and $value['maj_nuit'] == 1) {
                            $tarif_maj = ($tarif_first * 50) / 100;
                        } elseif ($value['maj_weekend'] == 1) {
                            $tarif_maj = ($tarif_first * 25) / 100;
                        } elseif ($value['maj_nuit'] == 1) {
                            $tarif_maj = ($tarif_first * 50) / 100;
                        } else {
                            $tarif_maj = 0;
                        }
                        $tarif = ($tarif_first * $nbrj) + $tarif_maj + $frais_gestion + $remise + $value['jawaz'] + $value['carburant'];

                        array_push($myArray, (object)[
                            'id' => $value['id'],
                            'tarif' => $tarif,
                            'tarif_prestation' => $valu['tarif_prestation'],
                            'tarif_first' => $tarif_first,
                            'tarif_maj' => $tarif_maj,
                            'frais_gestion' => $frais_gestion,
                            'remise' => $remise,
                            'jawaz' => $value['jawaz'],
                            'carburant' => $value['carburant'],

                        ]);
                    }
                }
            }
        }
        //  dd($myArray);
        $typePrestation = $this->getDoctrine()
            ->getRepository(TypePrestation::class)
            ->findAll();


        $tbody = $this->render('facturer/facture_mission.html.twig', [
            'mission' => $mission,
            'all_sites' => $all_sites,
            'typePrestation' => $typePrestation,
            'tarif' => $myArray
        ])->getContent();
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(json_encode($tbody));
        return $response;
    }

    /**
     * @Route("/filter_table", name="filter_table")
     */
    public function filter_table(Request $request, SessionInterface $session): Response
    {

        $em = $this->getDoctrine()->getManager()->getConnection();
        $site = $request->get('site');
        $datedebut = $request->get('dated');
        $datefin = $request->get('datef');
        $requete = '';
        if (empty($datedebut)) {
        } else {

            $requete .= "and mc.date_depart>='$datedebut 00:00:00'";
        }
        if (empty($datefin)) {
        } else {
            $requete .= "and mc.date_depart<='$datefin 23:59:59'";
        }
        if (empty($site)) {
        } else {
            $requete .= "and pd.abreviation='$site'";
        }


        $site_all_requete = "SELECT DISTINCT mc.id as idm ,mc.benificiare,mc.date_depart,mc.date_retour,pd.description,mc.heure_depart,mc.nb_personnes,is_initier,is_valider ,mc.statut_id,statut,mc.tarif,mc.date_mission
        FROM `mission_cab` mc
        inner join p_dossier pd on mc.id_dossier=pd.id
        inner join status_mission sm on mc.statut_id=sm.id
        where 1=1  $requete AND is_valider=1 and statut_id=3";
        //dd($site_all_requete);
        $statement_all = $em->prepare($site_all_requete);
        $resultat_all = $statement_all->executeQuery();
        $sites_all = $resultat_all->fetchAll();
        return $this->render('facturer/filter.html.twig', [

            'mission' => $sites_all,
        ]);
    }

    /**
     * @Route("/excel/{site}/{dated}/{datef}", name="excel")
     */
    public function excel(Request $request, $site, $dated, $datef)
    {
        $em = $this->getDoctrine()->getManager()->getConnection();
        // $site = $request->get('site');
        // $datedebut = $request->get('dated');
        // $datefin = $request->get('datef');
        // dd($_Get['site']);
        $requete = '';
        if (empty($dated)) {
        } else {

            $requete .= "and mc.date_depart>='$dated 00:00:00'";
        }
        if (empty($datef)) {
        } else {
            $requete .= "and mc.date_depart<='$datef 23:59:59'";
        }
        if ($site == "empty") {
        } else {
            $requete .= "and pd.abreviation='$site'";
        }

        $spreadsheet = new Spreadsheet();

        $sql = "SELECT DISTINCT mc.id as idm ,pres.name,mc.adress_mission,mc.benificiare,mc.date_depart,mc.date_retour,pd.description,mc.heure_depart,mc.nb_personnes,rm.is_valider ,mc.statut_id,statut,mc.tarif,mc.date_mission
        FROM `mission_cab` mc
        inner join p_dossier pd on mc.id_dossier=pd.id
        inner join status_mission sm on mc.statut_id=sm.id
        inner join relation_mission rm on rm.mission_id_id=mc.id
        inner join prestation pres on pres.id=rm.prestation_id_id
        where 1=1  $requete AND rm.is_valider=1 and statut_id=3";

        $statement_all = $em->prepare($sql);
        $resultat_all = $statement_all->executeQuery();
        $sites_all = $resultat_all->fetchAll();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Site');

        $sheet->setCellValue('C1', 'Prestation');
        $sheet->setCellValue('D1', 'Adress');
        $sheet->setCellValue('E1', 'Date Debut');
        $sheet->setCellValue('F1', 'Date Fin');
        $sheet->setCellValue('G1', 'Heure');

        $sheet->setCellValue('H1', 'Tarif');




        $sheet->setTitle("My First Worksheet");
        $count = 2;
        // dd($sites_all);

        foreach ($sites_all  as $iteme => $valu) {


            $sheet->setCellValue('A' . $count, $valu['idm']);
            $sheet->setCellValue('B' . $count, $valu['description']);
            // $sheet->setCellValue('C' . $count, $valu['benificiare']);

            $sheet->setCellValue('C' . $count, $valu['name']);
            $sheet->setCellValue('D' . $count, $valu['adress_mission']);
            $sheet->setCellValue('E' . $count, $valu['date_depart']);
            $sheet->setCellValue('F' . $count, $valu['date_retour']);
            $sheet->setCellValue('G' . $count, $valu['heure_depart']);

            $sheet->setCellValue('H' . $count, $valu['tarif']);




            $count = $count + 1;
        }

        // Create your Office 2007 Excel (XLSX Format)
        $writer = new Xlsx($spreadsheet);

        // Create a Temporary file in the system
        $fileName = 'extractio.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);

        // Create the excel file in the tmp directory of the system
        $writer->save($temp_file);

        // Return the excel file as an attachment
        return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
    }
    /**
     * @Route("/facturer_traiter", name="facturer_traiter")
     */
    public function facturer_traiter(Request $request, SessionInterface $session): Response
    {
        $em = $this->getDoctrine()->getManager()->getConnection();
        $array_id = $request->get('array_id');

        $myArray = [];

        for ($i = 0; $i < count($array_id); $i++) {

            $mission_to_edit = "SELECT mission_cab.id as id, p_dossier.abreviation,mission_cab.benificiare,mission_cab.nb_personnes,mission_cab.ville_mission
            ,mission_cab.telephone,mission_cab.adress_mission,mission_cab.date_depart,mission_cab.date_retour,mission_cab.heure_depart,mission_cab.maj_nuit,mission_cab.maj_weekend
             FROM `mission_cab` INNER JOIN p_dossier ON p_dossier.id=mission_cab.id_dossier WHERE mission_cab.id=$array_id[$i]";
            $statement = $em->prepare($mission_to_edit);
            $resultat = $statement->executeQuery();
            $mission = $resultat->fetchAll();

            $sites = "SELECT prestation.name as nam,type_prestation.designation,type_vehicule.designation as veh,relation_mission.prestation_id_id,relation_mission.id,
                       relation_mission.km_depart as km,relation_mission.jawaz as jawaz,relation_mission.remise,relation_mission.carburant,mission_cab.maj_weekend,mission_cab.maj_nuit
             FROM `mission_cab`
             INNER JOIN relation_mission  ON relation_mission.mission_id_id=mission_cab.id
             INNER JOIN prestation        ON prestation.id=relation_mission.prestation_id_id
             INNER JOIN type_prestation   ON type_prestation.id=prestation.type_prestation_id
             INNER JOIN type_vehicule     ON prestation.type_vehicule_id=type_vehicule.id
             WHERE mission_cab.id=$array_id[$i]";
            $statement_site = $em->prepare($sites);
            $resultat_site = $statement_site->executeQuery();
            $all_sites = $resultat_site->fetchAll();

            $prestations = "SELECT * FROM `prestation`";
            $statement_pres = $em->prepare($prestations);
            $resultat_pres = $statement_pres->executeQuery();
            $all_presta = $resultat_pres->fetchAll();
            foreach ($all_sites as $item => $value) {

                foreach ($all_presta as $iteme => $valu) {
                    if ($valu['id'] == $value['prestation_id_id']) {
                        //test kilometrage

                        if ($valu['kilometrage'] == 1) {

                            $tarif_first = $value['km'] * $valu['tarif_prestation'];
                            $frais_gestion = ($value['jawaz'] + $value['carburant']) * 0.02;

                            $remise = $value['remise'];



                            if ($value['maj_weekend'] == 1 and $value['maj_nuit'] == 1) {
                                $tarif_maj = ($tarif_first * 50) / 100;
                                // dd($value['jawaz']);


                            } elseif ($value['maj_weekend'] == 1) {
                                $tarif_maj = ($tarif_first * 25) / 100;
                            } elseif ($value['maj_nuit'] == 1) {
                                $tarif_maj = ($tarif_first * 50) / 100;
                            } else {
                                $tarif_maj = 0;
                            }
                            $tarif = $tarif_first + $tarif_maj + $frais_gestion + $remise + $value['jawaz'] + $value['carburant'];


                            array_push($myArray, (object)[
                                'id' => $value['id'],
                                'tarif' => $tarif,
                                'tarif_prestation' => $valu['tarif_prestation'],
                                'tarif_first' => $tarif_first,
                                'tarif_maj' => $tarif_maj,
                                'frais_gestion' => $frais_gestion,
                                'remise' => $remise,
                                'jawaz' => $value['jawaz'],
                                'carburant' => $value['carburant'],

                            ]);
                        } else {
                            $tarif_first = $valu['tarif_prestation'];
                            $remise = $value['remise'];
                            $frais_gestion = ($value['jawaz'] + $value['carburant']) * 0.02;

                            if ($value['maj_weekend'] == 1 and $value['maj_nuit'] == 1) {
                                $tarif_maj = ($tarif_first * 50) / 100;
                            } elseif ($value['maj_weekend'] == 1) {
                                $tarif_maj = ($tarif_first * 25) / 100;
                            } elseif ($value['maj_nuit'] == 1) {
                                $tarif_maj = ($tarif_first * 50) / 100;
                            } else {
                                $tarif_maj = 0;
                            }
                            $tarif = $tarif_first + $tarif_maj + $frais_gestion + $remise + $value['jawaz'] + $value['carburant'];

                            array_push($myArray, (object)[
                                'id' => $value['id'],
                                'tarif' => $tarif,
                                'tarif_prestation' => $valu['tarif_prestation'],
                                'tarif_first' => $tarif_first,
                                'tarif_maj' => $tarif_maj,
                                'frais_gestion' => $frais_gestion,
                                'remise' => $remise,
                                'jawaz' => $value['jawaz'],
                                'carburant' => $value['carburant'],

                            ]);
                        }
                    }
                }
            }
        }


        dd($myArray);

        return $response;
    }
}
//    -- inner join relation_mission rm on rm.mission_id_id=mc.id
//         -- inner join prestation pres on pres.id=rm.prestation_id_id