<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('commande')]
class CommandeController extends AbstractController
{
    #[Route('/new', name: 'new_commande')]
    public function newCommande(): Response
    {
        return $this->render('commande/new.html.twig');
    }
      #[Route('/liste', name: 'liste_commande')]
    public function listeCommande(): Response
    {
        return $this->render('commande/liste.html.twig');
    }
}
