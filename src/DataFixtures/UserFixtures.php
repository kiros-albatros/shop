<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

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
}
