<?php

namespace App\Controller;

use App\Repository\SellerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SellersController extends AbstractController
{
    #[Route('/sellers/{slug}', name: 'app_seller_show')]
    public function show(SellerRepository $sellerRepository, $slug): Response
    {
        $seller = $sellerRepository->find($slug);
        return $this->render('sellers/show.html.twig', [
            'controller_name' => 'SellersController',
            'seller' => $seller
        ]);
    }
}
