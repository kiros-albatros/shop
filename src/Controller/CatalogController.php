<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SellerRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogController extends AbstractController
{
    #[Route('/catalog', name: 'app_catalog')]
    public function index(Request $request, PaginatorInterface $paginator, SellerRepository $sellerRepository, CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
       // dd($request->query->all());
        $products = $productRepository->findAllWithSearchQuery($request->query->get('query'));
        $pagination = $paginator->paginate(
            $products, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            8 /*limit per page*/
        );
        $sellers = $sellerRepository->findAll();
      //  dd($request->query->get('query'));

        $categories = $categoryRepository->findAll();
        return $this->render('catalog/index.html.twig', [
            'controller_name' => 'CatalogController',
            'categories'=>$categories,
         //   'products'=>$products,
            'sellers'=>$sellers,
            'pagination'=>$pagination
        ]);
    }
}
