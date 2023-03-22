<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Review;
use App\Repository\CategoryRepository;
use DateTime;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends BaseFixtures
{

//    protected $categoryData = ['Accessories', 'Bags', 'Cameras', 'Clothing', 'Clothing', 'Electronics', 'Fashion', 'Furniture',
//        'Mobile', 'Trends', 'Other'];
    public function loadData(ObjectManager $manager)
    {

        $this->createMany(Product::class, 40, function (Product $product) use ($manager) {
            $categories = $manager->getRepository(Category::class)->findAll();

            $product
                ->setName($this->faker->word)
                ->setImage($this->faker->url)
                ->setDescription($this->faker->paragraph(45))
                ->setPrice($this->faker->numberBetween(1, 2000))
                ->setReviewsCount($this->faker->numberBetween(0, 10))
                ->setSellersCount($this->faker->numberBetween(0, 10))
                ->setIsLimited($this->faker->boolean())
                ->setDiscount($this->faker->numberBetween(0, 90))
                ->setSortIndex($this->faker->numberBetween(1, 100))
                ->setSalesCount($this->faker->numberBetween(1, 200))
                ->setCategory($this->faker->randomElement($categories))
                ;

            for ($i = 0; $i < $this->faker->numberBetween(2, 10); $i++) {
                $this->addReview($product, $manager);
            }
        });
    }

    /**
     * @param Product $product
     * @param ObjectManager $manager
     * @return void
     */
    function addReview(Product $product, ObjectManager $manager): void
    {
        $review = (new Review())
            ->setAuthorName($this->faker->name)
            ->setAuthorEmail($this->faker->email)
            ->setContent($this->faker->paragraph)
            ->setCreatedAt($this->faker->dateTimeBetween('-100 days', '-1 day'))
            ->setUpdatedAt(new DateTime("now"))
            ->setProduct($product);

        $manager->persist($review);
    }
}
