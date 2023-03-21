<?php

namespace App\Controller;

use App\Form\ProfileEditFormType;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile_index')]
    public function index(CategoryRepository $categoryRepository,): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'categories'=>$categories
        ]);
    }

    #[Route('/profile/edit', name: 'app_profile_edit')]
    public function profile(Request $request, CategoryRepository $categoryRepository,  ManagerRegistry $doctrine, SluggerInterface $slugger): Response
    {
        $categories = $categoryRepository->findAll();
        $user = $this->getUser();
        $form = $this->createForm(ProfileEditFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $file = $form->get('avatar')->getData();

            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = '/uploads/avatars/'. $safeFilename.'.'.$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('avatars_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setAvatar($newFilename);
            }

            $entityManager = $doctrine->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_index');
        }

        return $this->render('profile/edit.html.twig', [
            'controller_name' => 'ProfileController',
            'form'=>$form->createView(),
            'categories'=>$categories
        ]);
    }
}
