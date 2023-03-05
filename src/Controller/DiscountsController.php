<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscountsController extends AbstractController
{
    #[Route('/discounts', name: 'app_discounts')]
    public function index(): Response
    {
        return $this->render('discounts/index.html.twig', [
            'controller_name' => 'DiscountsController',
        ]);
    }
}
