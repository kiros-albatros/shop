<?php

namespace App\Service;

use App\Entity\Review;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ReviewService
{
    public function addReview($formData, EntityManagerInterface $entityManager)
    {
        $review = new Review();
        $review
            ->setProduct($formData['product'])
            ->setAuthorName($formData['author_name'])
            ->setAuthorEmail($formData['author_email'])
            ->setContent($formData['content'])
            ->setCreatedAt(new \DateTime("now"))
            ->setUpdatedAt(new \DateTime("now"));
        ;

        $entityManager->persist($review);
        $entityManager->flush();
    }
}