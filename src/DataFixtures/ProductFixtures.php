<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;

// todo добавить связь с категориями

class ProductFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {


        $this->createMany(Product::class, 10, function (Product $product) use ($manager) {
            $product
                ->setName($this->faker->word)
                ->setImage($this->faker->url)
                ->setDescription($this->faker->paragraph(75))
                ->setPrice($this->faker->numberBetween(1, 2000))
                ->setReviewsCount($this->faker->numberBetween(0, 50))
                ->setSellersCount($this->faker->numberBetween(0, 10))
                ->setIsLimited($this->faker->boolean())
                ->setDiscount($this->faker->numberBetween(0, 90))
                ->setSortIndex($this->faker->numberBetween(1, 100))
                ->setSalesCount($this->faker->numberBetween(1, 200))
                ;

            $manager->persist($product);
        });
    }
}
