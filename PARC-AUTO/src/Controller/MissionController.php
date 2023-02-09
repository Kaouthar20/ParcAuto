<?php

namespace App\Controller;

use DateTime;
use Mpdf\Mpdf;
use App\Entity\Site;
use App\Entity\Mission;
use App\Entity\Vehicule;
use App\Entity\Conducteur;
use App\Entity\MissionCab;
use App\Entity\Prestation;
use App\Entity\StatusMission;
use App\Entity\TypePrestation;
use App\Entity\RelationMission;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

class MissionController extends AbstractController
{
    /**
     * @Route("/mission", name="mission")
     */
    public function index(Request $request,SessionInterface $session,AccessDecisionManagerInterface $accessDecisionManager): Response
    {

        $session = $request->getSession();
        $session->start();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getManager()->getConnection();
        $mission= $this->getDoctrine()
        ->getRepository(MissionCab::class)
        ->findAll();
       $typePrestation = $this->getDoctrine()
        ->getRepository(TypePrestation::class)
        ->findAll();
      
        
        $user = $this->getUser()->getRoles();
        
        $session->set('ROLES', $user[0]);
        if ($user[0] == 'ROLE_USER') {
            $site = $session->get('iddossier');
               $requete = "where id_dossier=$site";
            }else if ($user[0] == 'ROLE_ADMIN') {
                $requete = "";
    
               
            }
        $site_all_requete="SELECT mc.id as idm ,mc.date_mission,mc.benificiare,mc.user_add_mission as benif,mc.date_depart,mc.date_retour,pd.description as abreviation,mc.heure_depart,mc.nb_personnes,is_initier,is_valider ,mc.statut_id,statut

        FROM `mission_cab` mc inner join p_dossier pd on mc.id_dossier=pd.id inner join status_mission sm on mc.statut_id=sm.id $requete ORDER BY mc.id DESC";
       
        $statement_all = $em->prepare($site_all_requete);
        $resultat_all = $statement_all->executeQuery();
        $sites_all = $resultat_all->fetchAll();
        return $this->render('mission/index.html.twig', [
            'typePrestation' => $typePrestation,
            // 'idsite' =>$abrev,
           
            'mission' => $sites_all,
        ]);
    }


    /**
     * @Route("/demande_mission", name="demande_mission")
     */
    public function demande_mission(SessionInterface $session): Response
    {
        $em = $this->getDoctrine()->getManager()->getConnection();
        $site = $session->get('iddossier');
        $mission= $this->getDoctrine()
        ->getRepository(MissionCab::class)
        ->findAll();
       $typePrestation = $this->getDoctrine()
        ->getRepository(TypePrestation::class)
        ->findAll();
        $tbody = $this->render('includes/modaldemande_first.html.twig', [
            'typePrestation' => $typePrestation,
            
        ])->getContent();
    $response = new Response();
    $response->headers->set('Content-Type', 'application/json');
    $response->setContent(json_encode($tbody));
    return $response;
       
    }
     /**
     * @Route("/getdossier", name="getdossier")
     */
    public function getdossier(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager()->getConnection();
       
        // $site = $this->getDoctrine()
        // ->getRepository(Site::class)
        // ->findAll();
      
        $site = intval($request->get('iddossier'));
        // dd($site);
        $site_all_requete="SELECT id,abreviation FROM `p_dossier` where id = $site ";
       
        $statement_all = $em->prepare($site_all_requete);
        $resultat_all = $statement_all->executeQuery();
        $sites_all = $resultat_all->fetch();

        $session = $request->getSession();
                $session->start();
     
        $session->set('iddossier', $sites_all['id']);
        $session->set('abrev', $sites_all['abreviation']);
        // $idsite=strval( $abrev ) ;
        // return new JsonResponse($session);
       return die;
        // return $this->render('mission/index.html.twig', [
        //     'typePrestation' => $typePrestation,
        //     'idsite' =>$abrev,
           
        //     'mission' => $mission,
        // ]);
    }

    /**
     * @Route("/liste_mission_initier", name="liste_mission_initier")
     */
    public function liste_mission_initier(): Response
    {
        return $this->render('mission/mission_initier.html.twig', [
            'controller_name' => 'MissionController',
        ]);
    }
    /**
     * @Route("/accordion", name="accordion")
     */
    public function accordion(): Response
    {
        if ($this->container->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
          return $this->redirectToRoute('mission');
          
            }else if (($this->container->get('security.authorization_checker')->isGranted('ROLE_USER'))) {
    
                $em = $this->getDoctrine()->getManager()->getConnection();

                    $site_requete="SELECT * FROM `pdossier_organisation` WHERE `active`=1";
                    $statement = $em->prepare($site_requete);
                    $resultat = $statement->executeQuery();
                    $sites = $resultat->fetchAll();

                    $site_all_requete="SELECT * FROM `p_dossier`";
                    $statement_all = $em->prepare($site_all_requete);
                    $resultat_all = $statement_all->executeQuery();
                    $sites_all = $resultat_all->fetchAll();


                  
            }
            return $this->render('mission/accordion.html.twig', [
                'controller_name' => 'MissionController',
                'sites' => $sites,
                'sites_all' => $sites_all,
            ]);
       
    }
    /**
     * @Route("/liste_mission_valider", name="liste_mission_valider")
     */
    public function liste_mission_valider(): Response
    {
        return $this->render('mission/mission_valider.html.twig', [
            'controller_name' => 'MissionController',
        ]);
    }

     /**
     * @Route("/repmlirPrestationByType/{id}", name="repmlirPrestationByType")
     */
    public function repmlirPrestationByType($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $prestation = $em->getRepository(Prestation::class)
        ->findBy(['type_prestation' => $id]);
        // dd($prestation);
        return $this->render('mission/DDLprestation.html.twig', [
            'prestation' => $prestation,
        ]); 
    }
     /**
     * @Route("/repmlirPrestationByType_v2/{id}", name="repmlirPrestationByType_v2")
     */
    public function repmlirPrestationByType_v2($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $prestation = $em->getRepository(Prestation::class)
        ->findBy(['type_prestation' => $id]);
        // dd($prestation);
        return $this->render('mission/DDLprestation_2.html.twig', [
            'prestation' => $prestation,
        ]);
    }
    /**
     * @Route("/repmlirVehiculeByPrestation/{id}", name="repmlirVehiculeByPrestation")
     */
    public function repmlirVehiculeByPrestation($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $prestation = $em->getRepository(Prestation::class)
        ->findOneBy(['id' => $id]);
        $typevehicule=$prestation->getTypeVehicule();
        return $this->render('mission/DDLtypevehicule.html.twig', [
            'typevehicule' => $typevehicule,
        ]);
    }

      // ================= Ajouter Mission ================= M

    /**
     * @Route("/addMission", name="addMission")
     */
    public function addMission(Request $request,ManagerRegistry $doctrine,SessionInterface $session): Response
    {   
        $em = $this->getDoctrine()->getManager();
        $current_day= new \DateTime('now');
        $current_day = $current_day->format('Y-m-d');
        $dateD=new DateTime($request->get('dateDepart'));
        $dateD=$dateD->format('Y-m-d');
        $dateR=new DateTime($request->get('dateRetour'));
        $dateR=$dateR->format('Y-m-d');
        $heure=new DateTime($request->get('Heure'));
        $heure=$heure->format('H:i:s');

        // dd($dateD);
        // dd($current_day);
        // $idcarte = $request->get('idcarte');
        // $date = $request->get('datevalidite');
        // $date2=new DateTime($date);
        // $obs = $request->get('obs');
       
        $site = $session->get('iddossier');
        // $beneficiaire = $em->getRepository(ClientBeneficiaire::class)->find($request->get('beneficiaire'));
        // $tarif = $em->getRepository(TypeTarif::class)->find($request->get('tarif'));


        $entityManager = $doctrine->getManager();
        $MissionCab = new MissionCab();
        $MissionCab->setDateMission(\DateTime::createFromFormat('Y-m-d',$current_day));
        $MissionCab->setVilleMission($request->get('ville'));
        $MissionCab->setAdressMission($request->get('adresse'));
        $MissionCab->setDateDepart(\DateTime::createFromFormat('Y-m-d',$dateD));
        $MissionCab->setDateRetour(\DateTime::createFromFormat('Y-m-d',$dateR));
        $MissionCab->setNbPersonnes($request->get('npt'));
        $MissionCab->setTelephone(intval($request->get('numTel')));
        $MissionCab->setHeureDepart($heure);
        $MissionCab->setIdDossier($site);
        $MissionCab->setBenificiare($request->get('demandeur'));
        $MissionCab->setUserAddMission($request->get('benif'));
        $MissionCab->setMajWeekend(0);
        $MissionCab->setMajNuit(0);
        $MissionCab->setStatut($em->getRepository(StatusMission::class)->find(1));

        $entityManager->persist($MissionCab);

        $entityManager->flush();

        $idDemande=$MissionCab->getId();
        return new JsonResponse($idDemande);
        
        

    }

     // ================= Ajouter Mission ================= M

    /**
     * @Route("/addPrestationMission", name="addPrestationMission")
     */
    public function addPrestationMission(Request $request,ManagerRegistry $doctrine): Response
    {   
        $em = $this->getDoctrine()->getManager();
       try {
        $mission = $em->getRepository(MissionCab::class)->find($request->get('idmission'));
        $prestation = $em->getRepository(Prestation::class)->find($request->get('idprestation'));
        // $beneficiaire = $em->getRepository(ClientBeneficiaire::class)->find($request->get('beneficiaire'));
        // $tarif = $em->getRepository(TypeTarif::class)->find($request->get('tarif'));


        $entityManager = $doctrine->getManager();
        $rltMission = new RelationMission();
        $rltMission->setMissionId($mission);
        $rltMission->setPrestationId($prestation);
       

        $entityManager->persist($rltMission);

        $entityManager->flush();
       } catch (\Throwable $th) {
        //throw $th;
       }
       
        // return $this->redirectToRoute('mission');
        // $idDemande=$MissionCab->getId();
        return new JsonResponse('ok');
    

    }
     // ================= Editer Mission ================= M

    /**
     * @Route("/editPrestationMission", name="editPrestationMission")
     */
    public function editPrestationMission(Request $request,ManagerRegistry $doctrine): Response
    {   
        $em = $this->getDoctrine()->getManager();
      
        $id_mission = $request->get('idmission');
        $idprestation = $request->get('idprestation');
        $weekend = $request->get('weekend');
        $nuit = $request->get('nuit');

        $mission = "UPDATE `mission_cab` SET `maj_weekend`=$weekend,`maj_nuit`=$nuit WHERE `id`=$id_mission";
        $statement = $em->getConnection()->prepare($mission);
        $resultat = $statement->executeQuery();
        foreach ($idprestation as &$value) {
            if ($value != 0) {
                $prestation = "INSERT INTO `relation_mission`( `mission_id_id`, `prestation_id_id`) VALUES ($id_mission,$value)";
                $statement_all = $em->getConnection()->prepare($prestation);
                $resultat_all = $statement_all->executeQuery();
            }
           
        }
       
     
        return new JsonResponse($id_mission);
    

    }
     // ================= Editer Mission ================= M

    /**
     * @Route("/deletePrestationMission", name="deletePrestationMission")
     */
    public function deletePrestationMission(Request $request,ManagerRegistry $doctrine): Response
    {   
        $em = $this->getDoctrine()->getManager();
       
      
        $id_mission = $request->get('idmission');
        
        $delete_prestation = "DELETE  FROM `relation_mission` WHERE `mission_id_id`=$id_mission";
        $statement_all = $em->getConnection()->prepare($delete_prestation);
        $resultat_all = $statement_all->executeQuery();


     
     
        return new JsonResponse('ok');
    

    }
     // ================= filter Mission ================= M

    /**
     * @Route("/filter/{id}", name="filter")
     */
    public function filter(Request $request,ManagerRegistry $doctrine,$id,SessionInterface $session): Response
    {   



        $em = $this->getDoctrine()->getManager()->getConnection();
        $site = $session->get('iddossier');
        $mission= $this->getDoctrine()
        ->getRepository(MissionCab::class)
        ->findAll();
        $typePrestation = $this->getDoctrine()
        ->getRepository(TypePrestation::class)
        ->findAll();
        $user = $this->getUser()->getRoles();
        $session->set('ROLES', $user[0]);
        if ($user[0] == 'ROLE_USER') {
               $requete = "id_dossier=$site and mc.statut_id=$id";
            }else if ($user[0] == 'ROLE_ADMIN') {
                $requete = " mc.statut_id=$id";
    
               
            }
        
       
        $site_all_requete="SELECT mc.id as idm ,mc.date_mission,mc.benificiare,mc.date_depart,mc.date_retour,pd.abreviation,mc.heure_depart,mc.nb_personnes,is_initier,is_valider ,mc.statut_id,statut

        FROM `mission_cab` mc inner join p_dossier pd on mc.id_dossier=pd.id inner join status_mission sm on mc.statut_id=sm.id  where $requete";

        $statement_all = $em->prepare($site_all_requete);
        $resultat_all = $statement_all->executeQuery();
        $sites_all = $resultat_all->fetchAll();

        return $this->render('includes/tbodymissionfiltre.html.twig', [
            'typePrestation' => $typePrestation,
            // 'idsite' =>$abrev,
        
            'mission' => $sites_all,
        ]);
    

    }
     // ================= Editer /  Mission ================= M

    /**
     * @Route("/editermission/{id}", name="editermission")
     */
    public function editermission(Request $request,ManagerRegistry $doctrine,$id): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();

       
        $mission_to_edit = "SELECT mission_cab.id as id, p_dossier.abreviation,mission_cab.benificiare,mission_cab.user_add_mission as benif,mission_cab.nb_personnes,mission_cab.ville_mission
        ,mission_cab.telephone,mission_cab.adress_mission,mission_cab.date_depart,mission_cab.date_retour,mission_cab.heure_depart,mission_cab.maj_nuit,mission_cab.maj_weekend
         FROM `mission_cab` INNER JOIN p_dossier ON p_dossier.id=mission_cab.id_dossier WHERE mission_cab.id=$id";
         $statement = $em->prepare($mission_to_edit);
         $resultat = $statement->executeQuery();
         $mission = $resultat->fetchAll();

         $sites = "SELECT relation_mission.prestation_id_id,prestation.name,type_prestation.designation,type_vehicule.designation as veh FROM `mission_cab`
         INNER JOIN relation_mission  ON relation_mission.mission_id_id=mission_cab.id
         INNER JOIN prestation        ON prestation.id=relation_mission.prestation_id_id
         INNER JOIN type_prestation   ON type_prestation.id=prestation.type_prestation_id
         LEFT JOIN type_vehicule     ON prestation.type_vehicule_id=type_vehicule.id
         WHERE mission_cab.id=$id";
        //  dd($sites);
         $statement_site = $em->prepare($sites);
         $resultat_site = $statement_site->executeQuery();
         $all_sites = $resultat_site->fetchAll();

         $typePrestation = $this->getDoctrine()
        ->getRepository(TypePrestation::class)
        ->findAll();
         $tbody = $this->render('includes/modaldemande.html.twig', [
                            'mission' => $mission,
                            'all_sites' => $all_sites,
                            'typePrestation' => $typePrestation
                        ])->getContent();
                    $response = new Response();
                    $response->headers->set('Content-Type', 'application/json');
                    $response->setContent(json_encode($tbody));
                    return $response;
    

    }


    // ================= Initier /  Mission ================= M

    /**
     * @Route("/initierMission/{id}", name="initierMission")
     */
    public function initierMission(Request $request,ManagerRegistry $doctrine,$id): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();

          $mission_to_edit = "SELECT mission_cab.id,p_dossier.description as abreviation,mission_cab.benificiare,mission_cab.nb_personnes,mission_cab.ville_mission
        ,mission_cab.telephone,mission_cab.adress_mission,mission_cab.date_depart,mission_cab.date_retour,mission_cab.heure_depart,mission_cab.maj_nuit,mission_cab.maj_weekend
         FROM `mission_cab` INNER JOIN p_dossier ON p_dossier.id=mission_cab.id_dossier WHERE mission_cab.id=$id";
         $statement = $em->prepare($mission_to_edit);
         $resultat = $statement->executeQuery();
         $mission = $resultat->fetchAll();
         $sites = "SELECT relation_mission.mission_id_id as missionid,relation_mission.is_initier,relation_mission.id,prestation.id as idp ,
         prestation.name,type_prestation.designation,type_vehicule.designation as veh ,prestation.conducteur as conduccheck,prestation.Kilometrage as kilocheck,
         relation_mission.is_initier,type_vehicule.designation,conducteur.nom_canducteur,relation_mission.km_depart,vehicule.matricule 
         FROM `mission_cab` 
         INNER JOIN relation_mission ON relation_mission.mission_id_id=mission_cab.id 
         INNER JOIN prestation ON prestation.id=relation_mission.prestation_id_id
         INNER JOIN type_prestation ON type_prestation.id=prestation.type_prestation_id 
         INNER JOIN type_vehicule ON prestation.type_vehicule_id=type_vehicule.id
         LEFT JOIN conducteur ON conducteur.id=relation_mission.conducteur_id_id
         LEFT JOIN vehicule ON vehicule.id=relation_mission.dm_retour WHERE mission_cab.id=$id";
         $statement_site = $em->prepare($sites);
         $resultat_site = $statement_site->executeQuery();
         $all_sites = $resultat_site->fetchAll();
         $typePrestation = $this->getDoctrine()
        ->getRepository(TypePrestation::class)
        ->findAll();
        $vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findAll();
        $conducteur = $this->getDoctrine()->getRepository(Conducteur::class)->findAll(); 
         $tbody = $this->render('includes/modalinitier.html.twig', [
                            'mission' => $mission,
                            'all_sites' => $all_sites,
                            'typePrestation' => $typePrestation,
                            'vehicule' => $vehicule,
                            'conducteur' => $conducteur,
                        ])->getContent();
                    $response = new Response();
                    $response->headers->set('Content-Type', 'application/json');
                    $response->setContent(json_encode($tbody));
                    return $response;


    }
    // ================= Valider /  Mission ================= M

    /**
     * @Route("/validerMission/{id}", name="validerMission")
     */
    public function validerMission(Request $request,ManagerRegistry $doctrine,$id): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();

       
       $mission_to_edit = "SELECT mission_cab.id as mission,p_dossier.description as abreviation,mission_cab.benificiare,mission_cab.nb_personnes,mission_cab.ville_mission
        ,mission_cab.telephone,mission_cab.adress_mission,mission_cab.date_depart,mission_cab.date_retour,mission_cab.heure_depart,mission_cab.maj_nuit,mission_cab.maj_weekend
         FROM `mission_cab` INNER JOIN p_dossier ON p_dossier.id=mission_cab.id_dossier WHERE mission_cab.id=$id";
         $statement = $em->prepare($mission_to_edit);
         $resultat = $statement->executeQuery();
         $mission = $resultat->fetchAll();

         $sites = "SELECT relation_mission.id,relation_mission.mission_id_id as mission,prestation.id as idp ,prestation.name,type_prestation.designation,type_vehicule.designation as veh,relation_mission.is_valider FROM `mission_cab`
         INNER JOIN relation_mission  ON relation_mission.mission_id_id=mission_cab.id
         INNER JOIN prestation        ON prestation.id=relation_mission.prestation_id_id
         INNER JOIN type_prestation   ON type_prestation.id=prestation.type_prestation_id
         INNER JOIN type_vehicule     ON prestation.type_vehicule_id=type_vehicule.id
         WHERE mission_cab.id=$id";
         $statement_site = $em->prepare($sites);
         $resultat_site = $statement_site->executeQuery();
         $all_sites = $resultat_site->fetchAll();

         $typePrestation = $this->getDoctrine()
        ->getRepository(TypePrestation::class)
        ->findAll();
         
         $tbody = $this->render('includes/modalinitier_2.html.twig', [
                            'mission' => $mission,
                            'all_sites' => $all_sites,
                            'typePrestation' => $typePrestation
                        ])->getContent();
                    $response = new Response();
                    $response->headers->set('Content-Type', 'application/json');
                    $response->setContent(json_encode($tbody));
                    return $response;
    
    

    }


     // ================= Initier v2 /  Mission ================= M

    /**
     * @Route("/initierMission_v2/{id}", name="initierMission_v2")
     */
    public function initierMission_v2(Request $request,ManagerRegistry $doctrine,$id): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();

     
         $Prestation = $this->getDoctrine()->getRepository(Prestation::class)->find($request->get('idprestation'));
        // dd($Prestation);initierMission
        $vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findAll();
        $relationMission=$request->get('idrelation_mission');
        $conducteur = $this->getDoctrine()->getRepository(Conducteur::class)->findAll();
        $tbody = $this->render('includes/modalinitier_v2.html.twig', [
                            'conducteur' => $conducteur,
                            // 'all_sites' => $all_sites,
                            'prestation' => $Prestation,
                            'vehicule'=>$vehicule,
                            'relationMission'=>$relationMission,
                        ])->getContent();
                    $response = new Response();
                    $response->headers->set('Content-Type', 'application/json');
                    $response->setContent(json_encode($tbody));
                    return $response;    
    }

     // ================= Initier v2 /  Mission ================= M

    /**
     * @Route("/validermission_v2/{id}", name="validermission_v2")
     */ 
    public function validermission_v2(Request $request,ManagerRegistry $doctrine,$id): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();
        $myArray = [];
        $idprestation = $request->get('idprestation');
        $idrelation_mission = $request->get('idrelation_mission');
        $carburant = $request->get('carburant');
        $jawaz = $request->get('jawaz');
        $remise = $request->get('remise');
        $nbrj = $request->get('nbrj');

        if (empty($remise)) {
            $requete = "";
        }
        else{
            $requete = ",`remise`=-$remise";

        }
        if (empty($jawaz)) {
            $requete_2 = "";
        }
        else{
            $requete_2 = ",`jawaz`=$jawaz";

        }
        if (empty($carburant)) {
            $requete_3 = "";
        }
        else{
            $requete_3 = ",`carburant`=$carburant";

        }
        if (empty($nbrj)) {
            $requete_4 = "";
        }
        else{
            $requete_4 = ",`nbrj`=$nbrj";

        }

        $update = "UPDATE `relation_mission` SET `is_valider`=1 $requete_2 $requete_3 $requete_4 $requete WHERE `id`=$idrelation_mission";
        $statement_site = $em->prepare($update);
        
         $resultat_site = $statement_site->executeQuery();
         
         
       
       
         return new JsonResponse($idrelation_mission);
    
    }

      /**
     * @Route("/confirmerInitiation/{id}", name="confirmerInitiation")
     */
    public function confirmerInitiation(Request $request,ManagerRegistry $doctrine,$id): Response
    {   

        // $mpdf=new \Mpdf\Mpdf();
        $em = $this->getDoctrine()->getManager()->getConnection();
        $entityManager = $doctrine->getManager();
     
         $rltMission = $this->getDoctrine()
        ->getRepository(RelationMission::class)
        ->find($id);
        // dd($rltMission);
        // $relationMission=$request->get('idrelation_mission');
        
       
        if(!empty($request->get('idconducteur'))){
        $conducteur = $this->getDoctrine()
        ->getRepository(Conducteur::class)
        ->find($request->get('idconducteur'));
            $rltMission->setConducteurId($conducteur);
        }
        
        $vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->find($request->get('idvehicule'));
        $rltMission->setDmRetour($vehicule->getId());
        $rltMission->setIsInitier(1);
        $rltMission->setKmDepart($request->get('kilometrage'));
        
        // $rltMission->setConducteurId($request->get('idconducteur'))
        $entityManager->persist($rltMission);

        $entityManager->flush();

        // $html = $this->renderView('etatSortie/initier.html.twig', [
        //     'prestation'=>$rltMission,
        // ]);
        // // $mpdf->SetJS('this.print();');
        // $mpdf->WriteHTML($html);
        // $mpdf->output('result.pdf','I');



   
        $idrlt=$rltMission->getId();
        return new JsonResponse($idrlt);

    }
      /**
     * @Route("/etatInitier/{id}", name="etatInitier")
     */
    public function etatInitier(Request $request,ManagerRegistry $doctrine,$id): Response
    {   

        $mpdf=new \Mpdf\Mpdf();

        $em = $this->getDoctrine()->getManager()->getConnection();
//         $entityManager = $doctrine->getManager();
     
//          $rltMission = $this->getDoctrine()
//         ->getRepository(RelationMission::class)
//         ->find($id);
       
//          $vehicule = $this->getDoctrine()
//         ->getRepository(Vehicule::class)
//         ->find($rltMission->getDmRetour());
//  dd($vehicule);
//         // $relationMission=$request->get('idrelation_mission');
        $sql="SELECT prestation.name,prestation.observation,relation_mission.id,mission_cab.ville_mission,mission_cab.user_add_mission as ben,mission_cab.date_mission,p_dossier.abreviation,p_dossier.nom_dossier,mission_cab.benificiare,mission_cab.user_add_mission as benif,mission_cab.date_depart,mission_cab.date_retour,mission_cab.heure_depart,mission_cab.telephone,conducteur.nom_canducteur,vehicule.matricule,relation_mission.km_depart,mission_cab.statut_id FROM `relation_mission` INNER JOIN mission_cab ON mission_cab.id=relation_mission.mission_id_id LEFT JOIN vehicule ON vehicule.id=relation_mission.dm_retour LEFT JOIN conducteur ON conducteur.id=relation_mission.conducteur_id_id INNER JOIN p_dossier ON p_dossier.id=mission_cab.id_dossier
              INNER JOIN prestation ON relation_mission.prestation_id_id=prestation.id
              WHERE relation_mission.id=$id";
         $statement_site = $em->prepare($sql);
         $resultat_site = $statement_site->executeQuery();
         $all_sites = $resultat_site->fetchAll();
        //  dd($all_sites);
        
       
       $footer = '

    <div class="tabFooter" style="line-height: 15px; text-align:center; border-top:1px solid black;"><span style="font-size: 9px ;">Av. Allal El Fassi Madinat Al Irfane Hay Riad 10000 Rabat</span><br/>
       <span style="font-size: 9px ;">Tel : 06.62.01.01.11</span><br/></div>';

        $html = $this->renderView('etatSortie/initier.html.twig', [
            'prestation'=>$all_sites,
            // 'vehicule'=>$vehicule,
        ]);
        // $mpdf->SetJS('this.print();');
        $mpdf->WriteHTML($html);
        $mpdf->SetFooter($footer);
        $mpdf->output('result.pdf','I');



   
      return die;
    }

      /**
     * @Route("/initiermissioncab/{id}", name="initiermissioncab")
     */
    public function initiermissioncab(Request $request,ManagerRegistry $doctrine,$id): Response
    {   

        $em = $this->getDoctrine()->getManager()->getConnection();

        $requete="SELECT COUNT(relation_mission.id) as cnt FROM `mission_cab` 
        INNER JOIN relation_mission  ON relation_mission.mission_id_id=mission_cab.id
        WHERE relation_mission.is_initier is Null AND mission_cab.id=$id";
        $statement_site = $em->prepare($requete);
        $resultat_site = $statement_site->executeQuery();
        $count = $resultat_site->fetch();

        if ($count['cnt'] == 0) {
            $entityManager = $doctrine->getManager();
     
            $Mission = $this->getDoctrine()
           ->getRepository(MissionCab::class)
           ->find($id);
           $Mission->setStatut($this->getDoctrine()
           ->getRepository(StatusMission::class)->find(2));
           $entityManager->persist($Mission);
   
           $entityManager->flush();
            $refresh = "yes";
        }
        else {
            $refresh = "no";
        }
    

       
       
        return  new JsonResponse($refresh);

    }

    // ================= valider Mission /  Mission ================= M

    /**
     * @Route("/validermission_f/{id}", name="validermission_f")
     */
    public function validermission_f(Request $request,ManagerRegistry $doctrine,$id): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();

        $myArray = [];

        $update = "UPDATE `mission_cab` SET `is_valider`=1,`statut_id`=3 WHERE `id`=$id";
        $statement_site = $em->prepare($update);
         $resultat_site = $statement_site->executeQuery();
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
         $tarif_globale = 0;
         foreach($all_sites as $item => $value){

         foreach($all_presta as $iteme => $valu){
             
             if(empty($value['nbrj'])){
                 
                 $nbrj = 1;
             }
             else{
                 $nbrj = $value['nbrj'];
             }
             
             
             
            if ($valu['id'] == $value['prestation_id_id']) {
                //test kilometrage

                if ($valu['kilometrage'] == 1) {

                     $tarif_first = $value['km'] * $valu['tarif_prestation'];
                     $frais_gestion = ($value['jawaz'] + $value['carburant']) * 0.02 ;

                     $remise = $value['remise'];

                    

                     if ($value['maj_weekend'] == 1 and $value['maj_nuit'] == 1) {
                        $tarif_maj = ($tarif_first *50) / 100;
                        // dd($value['jawaz']);
                     

                     }
                     elseif ($value['maj_weekend'] == 1) {
                        $tarif_maj = ($tarif_first *25) / 100;



                     }
                     elseif ($value['maj_nuit'] == 1) {
                        $tarif_maj = ($tarif_first *50) / 100;
           
                     }
                     else{
                        $tarif_maj = 0;
                     }
                     $tarif = ($tarif_first * $nbrj) + $tarif_maj + $frais_gestion + $remise + $value['jawaz'] + $value['carburant'];
                     $tarif_globale = $tarif_globale + $tarif;

                }
                else{
                    $tarif_first = $valu['tarif_prestation'];
                    $remise = $value['remise'];
                    $frais_gestion = ($value['jawaz'] + $value['carburant']) * 0.02 ;

                    if ($value['maj_weekend'] == 1 and $value['maj_nuit'] == 1) {
                        $tarif_maj = ($tarif_first *50) / 100;
                     

                     }
                     elseif ($value['maj_weekend'] == 1) {
                        $tarif_maj = ($tarif_first *25) / 100;


                     }
                     elseif ($value['maj_nuit'] == 1) {
                        $tarif_maj = ($tarif_first *50) / 100;
           
                     }
                     else{
                        $tarif_maj = 0;
                     }
                     $tarif = ($tarif_first * $nbrj) + $tarif_maj + $frais_gestion + $remise + $value['jawaz'] + $value['carburant'];
                      $tarif_globale = $tarif_globale + $tarif;
              
                }

            }

        }

         }
         
        $update_ = "UPDATE `mission_cab` SET `tarif`=$tarif_globale WHERE `id`=$id";
       
        $statement_site_ = $em->prepare($update_);
        $resultat_site = $statement_site_->executeQuery();
         return new JsonResponse($id);
    
    }
    // ================= vehicule /  Mission ================= M

    /**
     * @Route("/vehicule", name="vehicule")
     */
    public function vehicule(Request $request,ManagerRegistry $doctrine): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();

        

        $vehicule = "SELECT matricule,marque FROM `vehicule` INNER JOIN marque_vehicule ON vehicule.marque_id_id=marque_vehicule.id";
        $statement_site = $em->prepare($vehicule);
         $resultat_site = $statement_site->executeQuery();
         $vehicules = $resultat_site->fetchAll();
       
         return $this->render('parametrage/vehicule.html.twig', [
            'vehicule'=>$vehicules,
        ]);
    
    }
    // ================= vehicule /  DELETE ================= M

    /**
     * @Route("/delete_veh", name="delete_veh")
     */
    public function delete_veh(Request $request,ManagerRegistry $doctrine): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();

        
        $matricule = $request->get('matricule');
        
        $delete_vehicule = "DELETE FROM `vehicule` WHERE `matricule`='$matricule'";
        $statement_site = $em->prepare($delete_vehicule);
         $resultat_site = $statement_site->executeQuery();
     
       return new JsonResponse($matricule);
       
    
    }

    // ================= add_vehicule /  Mission ================= M

    /**
     * @Route("/add_vehi", name="add_vehi")
     */
    public function add_vehi(Request $request,ManagerRegistry $doctrine): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();
        $brand = $request->get('brand');
        $vehicule = $request->get('vehicule');
        $matricule = $request->get('matricule');


        $vehicule_exist = "SELECT * FROM `vehicule` where matricule='$matricule'";
         $statement = $em->prepare($vehicule_exist);
         $resultat = $statement->executeQuery();
         $vehicules = $resultat->fetchAll();

        $brand_exist = "SELECT * FROM `marque_vehicule` WHERE `marque`='$brand'";
         $statement_brand = $em->prepare($brand_exist);
         $resultat_brand = $statement_brand->executeQuery();
         $brands = $resultat_brand->fetchAll();

         if (empty($brands)) {
            $insert_brand = "INSERT INTO `marque_vehicule`(`marque`) VALUES ('$brand')";
            $statement_insert_b = $em->prepare($insert_brand);
            $resultat = $statement_insert_b->executeQuery();

            $id_brand = "SELECT * FROM `marque_vehicule` WHERE `marque`='$brand'";
            $statement_brand = $em->prepare($id_brand);
            $resultat_brand = $statement_brand->executeQuery();
            $brands = $resultat_brand->fetch();
            $brand_id = $brands['id'];


         }
         else {
            $id_brand = "SELECT * FROM `marque_vehicule` WHERE `marque`='$brand'";
            $statement_brand = $em->prepare($id_brand);
            $resultat_brand = $statement_brand->executeQuery();
            $brands = $resultat_brand->fetch();
            $brand_id = $brands['id'];

         }

         if (empty($vehicules)) {
            $vehicule = "INSERT INTO `vehicule`(`marque_id_id`, `matricule`) VALUES ($brand_id,'$matricule')";
            $statement_site = $em->prepare($vehicule);
            $resultat_site = $statement_site->executeQuery();
         }
         else {
            $vehicule = "UPDATE `vehicule` SET `marque_id_id`='$brand_id',`matricule`='$matricule' WHERE matricule='$matricule'";
            $statement_site = $em->prepare($vehicule);
            $resultat_site = $statement_site->executeQuery();


         }


        
       
         return new JsonResponse($brand_id);

    
    }
    // ================= conducteur /  Mission ================= M

    /**
     * @Route("/conducteur", name="conducteur")
     */
    public function conducteur(Request $request,ManagerRegistry $doctrine): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();

        

        $update = "SELECT * FROM `conducteur`";
        $statement_site = $em->prepare($update);
         $resultat_site = $statement_site->executeQuery();
         $conducteur = $resultat_site->fetchAll();

       
         return $this->render('parametrage/conducteur.html.twig', [
            'conducteur'=>$conducteur,
        ]);
    
    }


     // ================= add_conducteur /  Mission ================= M

    /**
     * @Route("/remove_conducteur", name="remove_conducteur")
     */
    public function remove_conducteur(Request $request,ManagerRegistry $doctrine): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();

        $matricule = $request->get('matricule');

        $conducteur_delete = "DELETE FROM `conducteur` where matricule_canducteur='$matricule'";
            $statement = $em->prepare($conducteur_delete);
        $resultat = $statement->executeQuery();
        return new JsonResponse($matricule);

    }
     // ================= add_conducteur /  Mission ================= M

    /**
     * @Route("/add_condu", name="add_condu")
     */
    public function add_condu(Request $request,ManagerRegistry $doctrine): Response
    {   
        $em = $this->getDoctrine()->getManager()->getConnection();
        $matricule = $request->get('matricule');
        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $situation = $request->get('situation');

        

        $conducteur_exist = "SELECT * FROM `conducteur` where matricule_canducteur='$matricule'";
         $statement = $em->prepare($conducteur_exist);
         $resultat = $statement->executeQuery();
         $conducteurs = $resultat->fetchAll();

       

         if (empty($conducteurs)) {
            $insert_conducteur = "INSERT INTO `conducteur`(`matricule_canducteur`, `nom_canducteur`, `situation_conducteur`, `Contact`) 
                             VALUES ('$matricule','$nom','$prenom','$situation')";
            $statement_insert_b = $em->prepare($insert_conducteur);
            $statement_insert_b = $em->prepare($insert_conducteur);
            $resultat = $statement_insert_b->executeQuery();

        


         }
         else {
            $update_conducteur = "UPDATE `conducteur` SET `nom_canducteur`='$nom',`situation_conducteur`='$prenom',`Contact`='$situation' 
                         WHERE matricule_canducteur='$matricule'";
            $statement_brand = $em->prepare($update_conducteur);
            $resultat_brand = $statement_brand->executeQuery();

         }

       


        
       
         return new JsonResponse($matricule);

    
    }

      /**
     * @Route("/annulerMission/{id}", name="annulerMission")
     */
    public function annulerMission(Request $request,ManagerRegistry $doctrine,$id): Response
    {   

        // $mpdf=new \Mpdf\Mpdf();

        $em = $this->getDoctrine()->getManager()->getConnection();
        $entityManager = $doctrine->getManager();
     
         $Mission = $this->getDoctrine()
        ->getRepository(MissionCab::class)
        ->find($id);
        $Mission->setStatut($this->getDoctrine()
        ->getRepository(StatusMission::class)->find(4));
        $entityManager->persist($Mission);

        $entityManager->flush();

       
       
        return die;

    }

      /**
     * @Route("/editermissions", name="editermissions")
     */
    public function editermissions(Request $request,ManagerRegistry $doctrine): Response
    {   

       $em = $this->getDoctrine()->getManager()->getConnection();

        $idmission = $request->get('idmission');
        $demandeur = $request->get('demandeur');
        $benif = $request->get('benif');
        $nbrP = $request->get('nbrP');
        $ville = $request->get('ville');
        $numTel = $request->get('numTel');
        $adresse = $request->get('adresse');
        $dateDepart = $request->get('dateDepart');
        $dateRetour = $request->get('dateRetour');
        $Heure = $request->get('Heure');
        $update = "UPDATE `mission_cab` SET `ville_mission`='$ville',`adress_mission`='$adresse',`date_depart`='$dateDepart',
                   `date_retour`='$dateRetour',`benificiare`='$demandeur',`nb_personnes`='$nbrP',`telephone`='$numTel',`heure_depart`='$Heure',`user_add_mission`='$benif' WHERE `id`='$idmission'";
             
        $statement_site = $em->prepare($update);
         $resultat_site = $statement_site->executeQuery();
     
         return new JsonResponse($idmission);


    }

}
