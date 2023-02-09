<?php

namespace App\Controller;
use App\Entity\Stock;
use App\Repository\StockRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('stock')]
class StockController extends AbstractController
{
    #[Route('/stockliste', name: 'liste_stock')]
    public function listStocks(ManagerRegistry $doctrine)
    {
        $stocks = $doctrine->getRepository(Stock::class)->findAll();

        return $this->render('stock/liste.html.twig', [
            'stocks' => $stocks,
        ]);
    }
  //create article from interface
    #[Route('/newStock', name: 'new_stock')]
    public function createArticles(ManagerRegistry $doctrine, Request $request)
    {

        //Get data from popup add_form action
        $em = $doctrine->getManager();
        $nom = $request->get('nom');
        $code = $request->get('code');
        $fabrique = $request->get('fabrique');
        $achete = $request->get('achete');
        $prixAchat = $request->get('prixAchat');
        $quantite = $request->get('quantite');
        $dateExp = $request->get('dateExp');
       
       
        if ($request->request->count() > 0) {

            $stock = new Stock();
            $stock->setNom($nom)
                 ->setCode($code)
                 ->setAchete(new \DateTime($fabrique))
                 ->setFabrique(new \DateTime($achete))
                 ->setPrixAchat($prixAchat)
                ->setQuantite($quantite)
                ->setDateExp(new \DateTime($dateExp))
                ;
            $em->persist($stock);
            $em->flush();
            // return $this->redirectToRoute('liste_article');
            return new JsonResponse('OK');
        }

    
}

}
