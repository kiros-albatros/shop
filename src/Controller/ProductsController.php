<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\Seller;
use App\Entity\SellerProduct;
use App\Form\RegistrationFormType;
use App\Form\ReviewFormType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use App\Repository\SellerProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController
{
    #[Route('/products/{slug}', name: 'app_product_show')]
    public function show($slug, ManagerRegistry $doctrine, SellerProductRepository $sellerProductRepository, Request $request, CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        $entityManager = $doctrine->getManager();

        $categories = $categoryRepository->findAll();
        $product = $productRepository->find($slug);
        $sellersInfo = $entityManager->getRepository(SellerProduct::class)->findBy(['product'=>$slug]);
        $sellers = [];
        for ($i = 0; $i < count($sellersInfo); $i++) {
            $sellerId = $sellersInfo[$i]->getSeller()->getId();
            $sellers[] = $entityManager->getRepository(Seller::class)->find($sellerId);
        }

       // $sellers = $productRepository->getProductSellers($slug);
     //   dd ($sellers);
       // dd($product);

        $review = new Review();
        $form = $this->createForm(ReviewFormType::class, $review, [
         //   'action' => $this->generateUrl('app_product_show', array('slug' =>$slug)),
         //   'method' => 'POST',
        ]);
      //  dd($request);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $review->setProduct($product);
            $review->setCreatedAt(new \DateTime('now'));
            $review->setUpdatedAt(new \DateTime('now'));
            $entityManager = $doctrine->getManager();
            $entityManager->persist($review);
            $entityManager->flush();
            return $this->redirectToRoute('app_product_show', array('slug' =>$slug));
        }

        return $this->render('products/product.html.twig', [
            'form'=>$form->createView(),
            'controller_name' => 'ProductsController',
            'categories'=>$categories,
            'product'=> $product,
            'sellers'=>$sellers
        ]);
    }
}
