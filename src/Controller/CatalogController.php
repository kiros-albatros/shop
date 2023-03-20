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
      //  dd($request->request->all());
        $products = $productRepository->findFilteredProducts($request->query->all());
        $pagination = $paginator->paginate(
            $products,
            $request->query->getInt('page', 1),
            8
        );
        $sellers = $sellerRepository->findAll();
      //  dd($request->query->get('query'));

        $categories = $categoryRepository->findAll();
        return $this->render('catalog/index.html.twig', [
            'controller_name' => 'CatalogController',
            'categories'=>$categories,
            'sellers'=>$sellers,
            'pagination'=>$pagination
        ]);
    }

#[Route('/catalog/{category}', name: 'app_catalog_category')]
public function category($category, Request $request, PaginatorInterface $paginator, SellerRepository $sellerRepository, CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
{
    $products = $productRepository->findFilteredProducts($request->query->all(), $category);

    $categories = $categoryRepository->findAll();
    $pagination = $paginator->paginate(
        $products,
        $request->query->getInt('page', 1),
        8
    );
  //  dd($pagination);
    $sellers = $sellerRepository->findAll();

    return $this->render('catalog/category.html.twig', [
        'controller_name' => 'CatalogController',
        'categories'=>$categories,
        'pagination'=>$pagination
    ]);
}
}
