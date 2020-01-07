<?php

namespace App\DataFixtures;

use App\Entity\Todo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TodoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++)
        {
            $todo = new Todo();
            $todo->setTitle("Todo #$i");
            $manager->persist($todo);
        }
        $manager->flush();
    }
}
