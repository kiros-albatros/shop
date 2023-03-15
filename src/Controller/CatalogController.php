<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogController extends AbstractController
{
    #[Route('/catalog', name: 'app_catalog')]
    public function index(CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        $categories = $categoryRepository->findAll();
        return $this->render('catalog/index.html.twig', [
            'controller_name' => 'CatalogController',
            'categories'=>$categories,
            'products'=>$products
        ]);
    }
}
