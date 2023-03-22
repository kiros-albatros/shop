<?php

namespace App\DataFixtures;

use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Product;
use App\Entity\Seller;
use App\Entity\SellerProduct;
use Doctrine\Persistence\ObjectManager;

class SellerProductFixtures extends BaseFixtures implements DependentFixtureInterface
{
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(SellerProduct::class, 200, function (SellerProduct $sellerProduct) use ($manager) {
            $sellerProduct
                ->setPrice($this->faker->numberBetween(100, 2000))
                ->setSeller($this->getRandomReference(Seller::class))
                ->setProduct($this->getRandomReference(Product::class))
            ;

            $manager->persist($sellerProduct);
        });
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class,
            SellerFixtures::class,
        ];
    }
}
