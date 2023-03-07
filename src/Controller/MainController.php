<?php

namespace App\Controller;

use App\Repository\BannerRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    protected $banners;

    #[Route('/', name: 'app_main')]
    public function index(BannerRepository $bannerRepository, CategoryRepository $categoryRepository): Response
    {
        // аццкий костыль - переделать в сервис?
        $categories = $categoryRepository->findAll();
        $banners = $bannerRepository->findBy(['is_active' => 1]);
        $bannersToShow = [];

        for ($i=0; $i <= 2; $i++) { 
            $rand_index = rand(0, count($banners)-1);
            $rand_banner = $banners[$rand_index];
            $bannersToShow[]=$rand_banner;
            unset($banners[$rand_index]);
            $banners = array_values($banners);
        }

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'banners' => $bannersToShow,
            'categories' => $categories,
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
    public function contact(): Response
    {
        return $this->render('pages/contacts.html.twig', [
            'controller_name' => 'MainController',
            'is_main' => false
        ]);
    }
}
