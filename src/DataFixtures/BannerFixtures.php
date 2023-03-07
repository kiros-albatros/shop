<?php

namespace App\DataFixtures;

use App\Entity\Banner;
use Doctrine\Persistence\ObjectManager;

class BannerFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {

        $this->createMany(Banner::class, 10, function (Banner $banner) use ($manager) {
            $banner
                ->setTitle($this->faker->sentence(3))
                ->setSubtitle($this->faker->sentence(15))
                ->setHref($this->faker->url())
                ->setIsActive($this->faker->boolean)
                ->setImage($this->faker->url());

            $manager->persist($banner);
        });
    }
}