<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;


class CatalogueController extends AbstractController
{
    #[Route('/catalogue', name: 'app_catalogue')]
    public function index(ProductRepository $productRepository): Response
    {
        $product= $productRepository->findAll();

        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            'product' => $product,
        ]);
    }
    public function show(?Product $product): Response{
        
        if(!$product){
            return $this->redirectToRoute("home");
        }

        return $this->render("catalogue/detail_products.html.twig",[
            'product' => $product
        ]);
    }
}
