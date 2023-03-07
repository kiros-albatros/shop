<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController
{
    #[Route('/products/{slug}', name: 'app_product_show')]
    public function show(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('products/product.html.twig', [
            'controller_name' => 'ProductsController',
            'categories'=>$categories
        ]);
    }
}
