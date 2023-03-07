<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SellersController extends AbstractController
{
    #[Route('/seller/{slug}', name: 'app_seller_show')]
    public function show(): Response
    {
        return $this->render('sellers/show.html.twig', [
            'controller_name' => 'SellersController',
        ]);
    }
}
