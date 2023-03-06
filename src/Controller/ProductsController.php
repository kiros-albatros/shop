<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/products/{slug}', name: 'app_product_show')]
    public function show(): Response
    {
        return $this->render('products/product.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }
}
