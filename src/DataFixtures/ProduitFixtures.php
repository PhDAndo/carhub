<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 100; $i++) {
            $produit = new produit();
            $produit
                ->setFournisseur($faker->word(1,true))
                ->setTitre($faker->word(3,true))
                ->setDescription($faker->sentences(4, true))
                ->setQuantiteStock($faker->numberBetween(1, 1000))
                ->setMarque($faker->word(2,true))
                ->setType($faker->sentences(3, true))
                ->setPrix($faker->numberBetween(200000, 50000000))
                ->setSold(false);
            $manager->persist($produit);
        }
        $manager->flush();
    }
}
