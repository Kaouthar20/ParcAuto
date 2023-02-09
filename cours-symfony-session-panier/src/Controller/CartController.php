<?php

namespace App\Controller;

use App\service\carte\CarteService;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/panier", name="cart_index")
     */
    public function index(CarteService $carteService)
    {//Afficher les produit qui sont dans le panier pour
       
        // $panierWithData=$carteService->getFullCarte();;
       
       
        // dd($panierWithData);
        // $total=0;
        // $total=$carteService->gettotale();
        // foreach($panierWithData as $item){
        //     $totalItem = $item['product']->getPrice() * $item['quantity'];
        //     $total += $totalItem;
        // }

        return $this->render('cart/index.html.twig', 
        [
            'items'=>$carteService->getFullCarte(),
            'total'=> $carteService->gettotale()
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="cart_add")
     */
    public function add($id, CarteService $carteService)
    {
    
$carteService->add($id);
     
    

        return $this->redirectToRoute('cart_index');
    }
     /**
     * @Route("/panier/remove/{id}", name="cart_remove")
     */
    public function remove($id, CarteService $carteService){
$carteService->remove($id);

  return $this->redirectToRoute("cart_index");

    }
}

