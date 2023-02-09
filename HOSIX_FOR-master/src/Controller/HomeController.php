<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home/sidbar', name: 'home_sidbar')]
    public function all(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/model.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/', name: 'default')]
    public function default(): Response
    {
        return $this->render('home/model.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/home/fiche', name: 'fiche')]
    public function fiche(): Response
    {
        return $this->render('home/fiche.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/home/commandes_internes', name: 'commandes_internes')]
    public function commandes_internes(): Response
    {
        return $this->render('home/commandes_internes.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
