<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $product = new Product();
            $product->setDesignation('product ' . $i);
            $product->setQte(mt_rand(10, 100));
            $manager->persist($product);
        }

        $manager->flush();

        $manager->flush();
    }
}
