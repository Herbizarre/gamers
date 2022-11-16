<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;

class HomeController extends AbstractController
{
    
    #[Route('/', name: 'app_home')]
    
    public function index(ProductRepository $productRepository): Response
    {
        $product = $productRepository->findBy([], [], 6, null);


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'product' => $product,
        ]);
    }
    public function show(?Product $product): Response{
        
        if(!$product){
            return $this->redirectToRoute("home");
        }

        return $this->render("home/detail_products.html.twig",[
            'product' => $product
        ]);
    }
}
