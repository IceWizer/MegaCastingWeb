<?php
namespace App\DataFixtures;

use App\Entity\CastingNumber;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CastingNumberFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create 5 CastingNumber

        $numbers = [5, 10, 25, 50, 100];
        $prices = [200, 300, 450, 650, 1000];

        for ($i = 0; $i < 5; $i++) {
            $castingNumber = new CastingNumber();
            $castingNumber->setCastingNumber($numbers[$i]);
            $castingNumber->setPrice($prices[$i]);
            $manager->persist($castingNumber);
        }

        $manager->flush();
    }
}
