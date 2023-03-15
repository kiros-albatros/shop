<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController
{
    #[Route('/products/{slug}', name: 'app_product_show')]
    public function show($slug, CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        $categories = $categoryRepository->findAll();
        $product = $productRepository->find($slug);
        return $this->render('products/product.html.twig', [
            'controller_name' => 'ProductsController',
            'categories'=>$categories,
            'product'=> $product
        ]);
    }
}
