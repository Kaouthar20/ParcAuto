<?php

namespace App\Controller;

use App\Entity\Famille;
use App\Repository\FamilleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('famille')]
class FamilleController extends AbstractController
{
    #[Route('/liste', name: 'liste_famille')]
    public function listFamilles(ManagerRegistry $doctrine)
    {
        $familles = $doctrine->getRepository(Famille::class)->findAll();

        return $this->render('famille/liste.html.twig', [
            'famills' => $familles
        ]);
    }

  
      //delete famille
    /**
     * @Route("/delete/{id}", name="delete_famille")
     */
    public function deleteFamille(ManagerRegistry $doctrine, Famille $famille)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($famille);
        $entityManager->flush();
        return $this->render('famille/liste.html.twig');
    }
}
