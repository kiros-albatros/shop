<?php

namespace App\DataFixtures;

use App\Entity\Discount;
use Doctrine\Persistence\ObjectManager;

class DiscountFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {  

        $this->createMany(Discount::class, 10, function (Discount $discount) use ($manager) {
            $discount
                ->setDescription($this->faker->sentence(20))
                ->setPercent($this->faker->numberBetween(5, 95))
                ->setIsActive($this->faker->boolean())
                ->setFromDate($this->faker->dateTimeBetween('-20 days', '-10 days'))
                ->setTillDate($this->faker->dateTimeBetween('-5 days', '20 day'));

            $manager->persist($discount);
        });
    }
}