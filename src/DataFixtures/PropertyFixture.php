<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $manager->flush();
    }
}
