<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\RegistrationFormType;
use App\Form\ReviewFormType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductsController extends AbstractController
{
    #[Route('/products/{slug}', name: 'app_product_show')]
    public function show($slug, ManagerRegistry $doctrine, Request $request, CategoryRepository $categoryRepository, ProductRepository $productRepository): Response
    {
        $categories = $categoryRepository->findAll();
        $product = $productRepository->find($slug);
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
            'product'=> $product
        ]);
    }
}
