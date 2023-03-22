<?php

namespace App\Controller;

use App\Repository\BannerRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SellerProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    protected $banners;

    #[Route('/', name: 'app_main')]
    public function index(ProductRepository $productRepository, SellerProductRepository $sellerProductRepository,  BannerRepository $bannerRepository, CategoryRepository $categoryRepository): Response
    {

        $categories = $categoryRepository->findAll();
        $banners = $bannerRepository->findBy(['is_active' => 1]);
        $counterLimit = count($banners);
        if ($counterLimit > 2) {
            $counterLimit = 2;
        }
        $bannersToShow = [];
        $topProducts = $productRepository->findBy([],['sort_index'=>'DESC'], 8);
      //  dd($topProducts);

        for ($i=0; $i <= $counterLimit; $i++) {
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
            'topProducts'=>$topProducts,
            'is_main' => true
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('pages/about.html.twig', [
            'controller_name' => 'MainController',
            'is_main' => false,
            'categories' => $categories,
        ]);
    }

    #[Route('/contacts', name: 'app_contacts')]
    public function contact(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('pages/contacts.html.twig', [
            'controller_name' => 'MainController',
            'is_main' => false,
            'categories' => $categories,
        ]);
    }
}
