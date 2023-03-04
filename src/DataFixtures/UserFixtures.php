<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
// use Faker\Factory;
// use Faker\Generator;

class UserFixtures extends BaseFixtures
{
    public function loadData(ObjectManager $manager)
    {


        $this->createMany(User::class, 10, function (User $user) use ($manager) {
            $user
                ->setEmail($this->faker->email)
                ->setName($this->faker->name)
                ->setPassword('123456')
                ->setRole('user');;

            $manager->persist($user);
        });
    }
    // protected $faker;
    // public function load(ObjectManager $manager): void
    // {
    //     $this->faker = Factory::create();
    //     $user = new User();
    //         $user
    //             ->setEmail($this->faker->email)
    //             ->setName($this->faker->name)
    //             ->setPassword('123456')
    //             ->setRole('user');

    //         $manager->persist($user);
    //         $manager->flush();

    // }
}
