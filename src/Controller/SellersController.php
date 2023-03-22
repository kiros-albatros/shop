<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\SellerProductRepository;
use App\Repository\SellerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SellersController extends AbstractController
{
    #[Route('/sellers/{slug}', name: 'app_seller_show')]
    public function show(SellerRepository $sellerRepository, SellerProductRepository $sellerProductRepository, $slug, ProductRepository $productRepository): Response
    {
        $seller = $sellerRepository->find($slug);
        $data = $sellerProductRepository->findBy(['seller' => $slug]);
        $products = [];
        for ($i = 0; $i < count($data); $i++) {
            $productId = $data[$i]->getProduct()->getId();
            // dd ($productId);
            $products[] = ['info'=>$productRepository->find($productId), 'price'=>$data[$i]->getPrice()];
            //   dd ($products);
        }
        // dd($products);
        return $this->render('sellers/show.html.twig', [
            'controller_name' => 'SellersController',
            'seller' => $seller,
            'products' => $products
        ]);
    }
}
