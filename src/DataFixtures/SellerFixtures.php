<?php

namespace App\DataFixtures;

use App\Entity\Seller;
use Doctrine\Persistence\ObjectManager;

class SellerFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Seller::class, 10, function (Seller $seller) use ($manager) {
            $seller
                ->setName($this->faker->company)
                ->setDescription($this->faker->text(255))
                ->setEmail($this->faker->email)
                ->setPhone($this->faker->phoneNumber)
                ->setAddress($this->faker->address)
                ->setImage($this->faker->url)
                ;

            $manager->persist($seller);
        });
    }
}
