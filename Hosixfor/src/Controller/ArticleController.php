<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Entity\Article;
use App\Entity\Famille;
use App\Entity\TypeArticle;
use App\Repository\StockRepository;
use App\Repository\ArticleRepository;
use App\Repository\FamilleRepository;
use App\Repository\TypeArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use phpDocumentor\Reflection\Types\Float_;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('article')]
class ArticleController extends AbstractController
{
    //saving objects to data base
    // #[Route('/addArticleToDatabase', name: 'create_article')]
    // public function addArticleTodataBase(ManagerRegistry $doctrine)
    // {
    //     $em = $doctrine->getManager();
    //     $stock = new Stock();
    //     $famille = new Famille();
    //     $article = new Article();
    //     $stock->setNom('stock numero 1');
    //     $stock->setCode(1);
    //     // $stock->addArticle($article);
    //     $em->persist($stock);
    //     // $famille->addArticle($article);
    //     $famille->setNom('Famille 1');
    //     $famille->setDescription("contenu de l'article");
    //     $em->persist($famille);
    //     $article->setNom('Doliprane');
    //     $article->setPrix(mt_rand(10, 100));
    //     $article->setQuantite(15);
    //     $article->setCode(001);
    //     $article->setDateExp(new \DateTime());
    //     $article->setStock($stock);
    //     $article->setFamille($famille);
    //     //tell Doctrine you want to (eventually) save the Personne (no queries yet)
    //     $em->persist($article);
    //     //actually executes the queries (i.e. the INSERT query)
    //     // $em->flush();

    //     return new Response('Saved new personne with id ' . $article->getId());
    //     // return $this->render(
    //     //     'article/detail.html.twig',
    //     //     [
    //     //         'article' => $article
    //     //     ]

    //     // );
    //}


  
    //fetching objects from database
    #[Route('/liste', name: 'liste_article')]
    public function articleListe(ManagerRegistry $doctrine)
    {
        $familles = $doctrine->getRepository(Famille::class)->findAll();
        $stocks = $doctrine->getRepository(Stock::class)->findAll();
        $articles = $doctrine->getRepository(Article::class)->findAll();
        $typeArticles = $doctrine->getRepository(TypeArticle::class)->findAll();
        

        // dd($articles);

       
        return $this->render('article/liste.html.twig', [
            'articles' => $articles,
            'familles' => $familles,
            'stocks' => $stocks,
            'typeArticles' => $typeArticles
        ]);
    }

    //create article from interface
    #[Route('/newArticle', name: 'new_article')]
    public function createArticles(ManagerRegistry $doctrine, Request $request)
    {

        //Get data from popup add_form action

        $nom = $request->get('nom');
        $prixAchat = $request->get('prixAchat');
        $quantite = $request->get('quantite');
        $code = $request->get('code');
        $dateExp = $request->get('dateExp');
        $idstock = $request->get('idstock');
        $idfamille = $request->get('idfamille');
        $idtypeArticle = $request->get('idtypeArticle');
        $famille = $doctrine->getRepository(Famille::class)->find($idfamille);
        $stock = $doctrine->getRepository(Stock::class)->find($idstock);
        $typeArticle = $doctrine->getRepository(TypeArticle::class)->find($idtypeArticle);
          $prixVente = $request->get('prixVente');
           $tva = $request->get('tva');
        $em = $doctrine->getManager();
        // $stocks = $doctrine->getRepository(Stock::class)->findAll();
        // $familles = $doctrine->getRepository(Famille::class)->findAll();
        //add new article
        if ($request->request->count() > 0) {

            // $stock = $doctrine->getRepository(Stock::class)->find($stock);
            // $famille = $doctrine->getRepository(Famille::class)->find($famille);
            $article = new Article();
            $article->setNom($nom)
                ->setPrixAchat($prixAchat)
                ->setQuantite($quantite)
                ->setCode($code)
                ->setDateExp(new \DateTime($dateExp))
                ->setStock($stock)
                ->setFamille($famille)
                ->setTypeArticle($typeArticle)
                ->setPrixVente($prixVente)
                ->setTva($tva)
                ;
            $em->persist($article);
            $em->flush();
            // return $this->redirectToRoute('liste_article');
            return new JsonResponse('OK');
        }

        // return $this->render('article/modals/add_form.html.twig', [
        //     'stocks' => $stocks,
        //     'familles' => $familles
        // ]);
    }
  //fetching object by {id}
    #[Route('liste/{id<\d+>}', name: 'detail_article')]

    public function findArticle(int $id, ArticleRepository $articleRepository)
    {
     
        $article = $articleRepository->find($id);
        // if (!$article) {
        //     $this->addFlash(
        //         'error',
        //         "l'article d'id $id n'existe pas"
        //     );
        //     return $this->redirectToRoute('liste_article');
        // }
        return $this->render('article/liste.html.twig', [

            'article' => $article
        ]);
    }

    //edit les informations de l'article
    #[Route('/update/{id}', name: 'update_article')]
    public function updateArticle(ManagerRegistry $doctrine, Article $article, ArticleRepository $articleRepository, Request $request): Response
    {
         dd($article);
        $em = $doctrine->getManager();
        if (!empty($request->get('nom'))) {
            $article = $articleRepository->find($article);

            $nom  = $request->get('nom');
            $prixAchat  = $request->get('prixAchat');
            $quantite = $request->get('quantite');
            $code = $request->get('code');
            $dateExp = $request->get('date');
           
            $article->setNom($nom)
                ->setPrixAchat($prixAchat)
                ->setQuantite($quantite)
                ->setCode($code)
                ->setDateExp(new \DateTime($dateExp));

            $em->flush();
            // return $this->redirectToRoute('liste_article');
               return new JsonResponse('OK');
        }


        // return $this->render(
        //     'article/update.html.twig',
        //     [
        //         'article' => $article,
        //     ]
        // );
    }


  
    //delete article
    /**
     * @Route("/delete/{id}", name="delete_article")
     */
    public function deleteArticle(ManagerRegistry $doctrine, Article $article)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($article);
        $entityManager->flush();
        return $this->redirectToRoute('liste_article');
    }
}
