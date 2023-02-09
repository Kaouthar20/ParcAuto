<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Entity\Article;
use App\Entity\Famille;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Float_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('article')]
class BackupController extends AbstractController
{


     //edit les informations de l'article
    // #[Route('/update/{id}', name: 'update_article')]
    // public function updateArticle(ManagerRegistry $doctrine, Article $article, ArticleRepository $articleRepository, Request $request): Response
    // {
    //     // dd($request);
    //     $em = $doctrine->getManager();
    //     if (!empty($request->get('nom'))) {
    //         $article = $articleRepository->find($article);

    //         $nom  = $request->get('nom');
    //         $prix  = $request->get('prix');
    //         $quantite = $request->get('quantite');
    //         $code = $request->get('code');
    //         $dateExp = $request->get('date');
    //         $article->setNom($nom)
    //             ->setPrix($prix)
    //             ->setQuantite($quantite)
    //             ->setCode($code)
    //             ->setDateExp(new \DateTime($dateExp));
                

    //         $em->flush();
    //         return $this->redirectToRoute('liste_article');
    //     }


    //     return $this->render(
    //         'article/update.html.twig',
    //         [
    //             'article' => $article,
    //         ]
    //     );
    // }
}
