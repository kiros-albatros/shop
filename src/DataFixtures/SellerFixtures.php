<?php

namespace App\DataFixtures;

use App\Entity\Seller;
use Doctrine\Persistence\ObjectManager;

class SellerFixtures extends BaseFixtures
{

    private static $avatars =[
        'images/sellers/1.png',
        'images/sellers/2.png',
        'images/sellers/3.png',
        'images/sellers/4.png',
        'images/sellers/5.png',
        'images/sellers/6.png',
        'images/sellers/7.png',
        'images/sellers/8.png',
        'images/sellers/9.png',
        'images/sellers/10.png',
    ];
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(Seller::class, 10, function (Seller $seller) use ($manager) {
            $seller
                ->setName($this->faker->company)
                ->setDescription($this->faker->text(255))
                ->setEmail($this->faker->email)
                ->setPhone($this->faker->phoneNumber)
                ->setAddress($this->faker->address)
                ->setImage($this->faker->randomElement(self::$avatars))
                ;

            $manager->persist($seller);
        });
    }
}
