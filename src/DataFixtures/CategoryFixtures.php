<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixtures
{
    public $categoryNames = [
        'Accessories',
        'Bags',
        'Cameras',
        'Clothing',
        'Electronics',
        'Fashion',
        'Furniture',
        'Mobile',
        'Trends',
        'More'
    ];

    public function loadData(ObjectManager $manager)
    {

        $this->createMany(Category::class, 10, function (Category $category) use ($manager) {
            $category
                ->setName($this->faker->randomElement($this->categoryNames))
                ->setImage($this->faker->url());

            $manager->persist($category);
        });
    }
}