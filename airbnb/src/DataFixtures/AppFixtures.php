<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\City;
use App\Entity\House;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$faker = \Faker\Factory::create('fr_FR');

    	for ($i = 0; $i < 50; $i++)
    	{
    		$city = new City();
    		$city->setName($faker->city);

    		for ($j = 0; $j < 20; $j++)
    		{
    			$house = new House();
    			$house->setTitle($faker->randomElement(["Maison", "Appartement", "Manoir", "Gîte", "Loft", "Cabane"]) . " " . $faker->streetName);
    			$house->setCity($city);
    			$manager->persist($house);
    		}
    		$manager->persist($city);
    	}


        // $product = new Product();
        // $manager->persist($product);



        $manager->flush();
    }
}
