<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\City;
use App\Entity\House;
use App\Entity\RentalType;

class AppFixtures extends Fixture
{

    const RENTAL_TYPES = ["Maison", "Appartement", "Manoir", "Gîte", "Loft", "Cabane"];

    public function load(ObjectManager $manager)
    {
    	$faker = \Faker\Factory::create('fr_FR');
        $types = [];

        foreach (self::RENTAL_TYPES as $t) {
            $type = new RentalType();
            $type->setTitle($t);
            $manager->persist($type);
            $types[] = $type;
        }

    	for ($i = 0; $i < 50; $i++)
    	{
    		$city = new City();
    		$city->setName($faker->city);

    		for ($j = 0; $j < 20; $j++)
    		{
    			$house = new House();
                $type = $faker->randomElement($types);
                $house->setType($type);
    			$house->setTitle($type->getTitle() . ' ' . $faker->streetName);
                $house->setPrice($faker->randomNumber(2));
                $house->setBedNumber($faker->randomNumber(1));
    			$house->setCity($city);
    			$manager->persist($house);
    		}
    		$manager->persist($city);
    	}

        $manager->flush();
    }
}
