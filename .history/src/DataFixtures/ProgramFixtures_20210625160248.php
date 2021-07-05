<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    const PROGRAMS =[
        'Walking dead',
        'The Haunting Of Hill House',
        'American Horror Story',
        'Love Death And Robots',
        'Penny Dreadful', 
        'Locke & Key',
        'Fear the Walking Dead'
        
    ];

    public function load(ObjectManager $manager)

    {

        foreach (self::CATEGORIES as $key => $categoryName) {

            $category = new Category();

            $category->setName($categoryName);

            $manager->persist($category);

            $this->addReference('category_' . $key, $category);

        }

        $manager->flush();

    }

}