<?php

namespace App\DataFixtures;

use App\Entity\ViewedProduct;
use Doctrine\Persistence\ObjectManager;

class ViewedProductFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {


        $this->createMany(ViewedProduct::class, 10, function (ViewedProduct $viewedProduct) use ($manager) {
            $viewedProduct
                ->setSellerId($this->faker->numberBetween(1, 10))
                ->setProductId($this->faker->numberBetween(1, 10))
                ;

            $manager->persist($viewedProduct);
        });
    }
}
