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
        for ($i = 0; $i < 100; $i++) {
            $sellerProduct = new SellerProduct();
            $randomSeller = $this->getRandomReference(Seller::class);
            $randomProduct = $this->getRandomReference(Product::class);
            $item = $manager->getRepository(SellerProduct::class)->findBy(['seller'=>$randomSeller, 'product'=>$randomProduct]);
            if (empty($item)) {
                $sellerProduct
                    ->setPrice($this->faker->numberBetween(100, 2000))
                    ->setSeller($randomSeller)
                    ->setProduct($randomProduct)
                ;
                $manager->persist($sellerProduct);
                $manager->flush();
            }
        }
    }

    public function getDependencies(): array
    {
        return [
            ProductFixtures::class,
            SellerFixtures::class,
        ];
    }
}
