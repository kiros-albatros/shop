<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends BaseFixtures
{
    public $categoryData = [
        ['name' => 'Accessories', 'image' => 'images/icons/departments/1.svg'],
        ['name' => 'Bags', 'image' => 'images/icons/departments/2.svg'],
        ['name' => 'Cameras', 'image' => 'images/icons/departments/3.svg'],
        ['name' => 'Clothing', 'image' => 'images/icons/departments/4.svg'],
        ['name' => 'Electronics', 'image' => 'images/icons/departments/5.svg'],
        ['name' => 'Fashion', 'image' => 'images/icons/departments/6.svg'],
        ['name' => 'Furniture', 'image' => 'images/icons/departments/7.svg'],
        ['name' => 'Mobile', 'image' => 'images/icons/departments/8.svg'],
        ['name' => 'Trends', 'image' => 'images/icons/departments/9.svg'],
        ['name' => 'More', 'image' => 'images/icons/departments/10.svg'],
    ];

    public function loadData(ObjectManager $manager)
    {
        for ($i = 0; $i < count($this->categoryData); $i++) {
            $this->create(Category::class, function (Category $category) use ($manager, $i) {
                $category
                    ->setName($this->categoryData[$i]['name'])
                    ->setImage($this->categoryData[$i]['image']);

                $manager->persist($category);
            });
        }
    }
}
