<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends BaseFixtures
{

    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }


    private static $avatars = [
        'uploads/avatars/bulgakov.png',
        'uploads/avatars/Chekhov.jpg',
        'uploads/avatars/gogol.jpg',
        'uploads/avatars/london.jpg',
        'uploads/avatars/mayakovski.jpeg',
        'uploads/avatars/pushkin.jpeg',
    ];

    public function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class, 10, function (User $user) use ($manager) {
            $user
                ->setEmail($this->faker->email)
                ->setName($this->faker->name)
                ->setPassword($this->userPasswordHasher->hashPassword(
                    $user,
                    123456
                ))
                ->setPhone($this->faker->phoneNumber)
                ->setAvatar($this->faker->randomElement(self::$avatars));

            $manager->persist($user);
        });
    }
}
