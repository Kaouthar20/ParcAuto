<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin1 = new User();
        $admin2 = new User();
        $plaintextPassword = 'admin';
        $hashedPassword = $this->passwordHasher->hashPassword($admin1, $plaintextPassword);
        $admin1->setUsername('admin1');
        $admin1->setRoles(['ROLE_ADMIN']);
        $admin1->setPassword($hashedPassword);
        $admin1->setEmail('admin1@gmail.com');
        //admin2
        $hashedPassword = $this->passwordHasher->hashPassword($admin2, $plaintextPassword);

        $admin2->setUsername('admin2');
        $admin2->setRoles(['ROLE_ADMIN']);

        $admin2->setPassword($hashedPassword);
        $admin2->setEmail('admin2@gmail.com');

        $manager->persist($admin1);
        $manager->persist($admin2);

        // $manager->flush();
    }
}
