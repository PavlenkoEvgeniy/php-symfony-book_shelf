<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user
            ->setEmail('admin@test.ru')
            ->setRoles(['ROLE_ADMIN', 'ROLE_USER'])
            ->setPassword($this->hasher->hashPassword($user, '123456'))
        ;

        $manager->persist($user);
        $manager->flush();
    }
}