<?php

namespace App\DataFixtures;

use App\Entity\BroadcastPartner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BroadcastPartnerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        // Create 50 BroadcastPartner with random data (Faker)
        for ($i = 0; $i < 50; $i++) {
            $broadcastPartner = new BroadcastPartner();
            $broadcastPartner->setLabel($faker->company);
            $manager->persist($broadcastPartner);
        }

        $manager->flush();
    }
}
