<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewsController extends AbstractController
{
    #[Route('/reviews', name: 'app_reviews')]
    public function index(): Response
    {
        return $this->render('reviews/index.html.twig', [
            'controller_name' => 'ReviewsController',
        ]);
    }
}
