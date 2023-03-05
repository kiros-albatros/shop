<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Persistence\ObjectManager;

// todo нормальную связку с юзерами

class ReviewFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {


        $this->createMany(Review::class, 10, function (Review $review) use ($manager) {
            $review
                ->setText($this->faker->sentence())
                ->setUserId($this->faker->numberBetween(1, 10))
                ->setProductId($this->faker->numberBetween(1, 10));

            $manager->persist($review);
        });
    }
}
