<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixtures
{

private static $avatars =[
'uploads/avatars/bulgakov.jpg',
'uploads/avatars/Chekhov.jpg',
'uploads/avatars/gogol.jpg',
'uploads/avatars/london.jpg',
'uploads/avatars/mayakovski.jpg',
'uploads/avatars/pushkin.jpg',
];

    public function loadData(ObjectManager $manager)
    {




        $this->createMany(User::class, 10, function (User $user) use ($manager) {
            $user
                ->setEmail($this->faker->email)
                ->setName($this->faker->name)
                ->setPassword('123456')
                ->setPhone($this->faker->phoneNumber)
                ->setAvatar($this->faker->randomElement(self::$avatars))
            ;

            $manager->persist($user);
        });
    }
}
