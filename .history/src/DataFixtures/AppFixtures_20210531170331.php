<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $season= new Season();
        $season->setNumber('1');
        $season->setYear('2010');
        $season->setNumber('1');
        $manager->persist($season);

        $manager->flush();
    }
}