<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'is_main' => true
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('pages/about.html.twig', [
            'controller_name' => 'MainController',
            'is_main' => false
        ]);
    }

    #[Route('/contacts', name: 'app_contacts')]
    public function contact (): Response
    {
        return $this->render('pages/contacts.html.twig', [
            'controller_name' => 'MainController',
            'is_main' => false
        ]);
    }
}
