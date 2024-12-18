<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $categories = [];
        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName($faker->word());
            $categories[] = $category;
            $manager->persist($category);
        }

        for ($i = 0; $i < 200; $i++) {
            $article = new Article();
            $article->setTitle($faker->realTextBetween(10,50))
                ->setContent($faker->realTextBetween(250, 1000))
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-2 years')))
                ->setVisible($faker->boolean(90))
                ->setCategory($faker->randomElement($categories));
            $manager->persist($article);
        }

        $manager->flush();
    }
}
