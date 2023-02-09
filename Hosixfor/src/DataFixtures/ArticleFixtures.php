<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Article;
use App\Entity\Famille;
use App\Entity\Stock;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 20; $i++) {
            $stock = new Stock();
            $famille = new Famille();
            $article = new Article();
            $date = new DateTime();
            $stock->setNom('stock :' . $i);
            $stock->setCode(random_int(001, 00100));
            $manager->persist($stock);
            $famille->setNom('Famille' . $i);
            $famille->setDescription("contenu de l'article" . $i);
            $manager->persist($famille);
            $article->setNom('article :' . $i)
                ->setPrix(mt_rand(10, 100))
                ->setQuantite(random_int(1, 200))
                ->setCode(random_int(01, 022222))
                ->setDateExp($date)
                ->setStock($stock)
                ->setFamille($famille);
            $manager->persist($article);
        }

        $manager->flush();
    }
}
