<?php

namespace App\DataFixtures;

use App\Entity\Duration;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DurationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create 5 durations

        $durations = ['30', '60', '120', '180', '360'];

        foreach ($durations as $d) {
            $duration = new Duration();
            $duration->setDuration($d);
            $duration->setPrice($d * 50);
            $manager->persist($duration);
        }

        $manager->flush();
    }
}
