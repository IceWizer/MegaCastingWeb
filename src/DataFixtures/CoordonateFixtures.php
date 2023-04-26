<?php

namespace App\DataFixtures;

use App\Entity\Coordonate;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CoordonateFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Create 1000 coordinates
        for ($i = 0; $i < 1000; $i++) {
            $coordinate = new Coordonate();
            $coordinate->setWebSite($faker->url);
            $coordinate->setEmail($faker->email);
            $coordinate->setPhoneNumber($faker->phoneNumber);
            $coordinate->setFaxNumber($faker->phoneNumber);
            $coordinate->setPostalLine1(substr($faker->streetAddress, 0, 33));
            $coordinate->setPostalLine2(substr($faker->locale, 0, 33));
            $coordinate->setPostalLine3(substr($faker->city, 0, 33));
            $coordinate->setPostalLine4(substr($faker->locale, 0, 33));
            $coordinate->setPostalLine5(substr($faker->country, 0, 33));
            $coordinate->setPostalLine6(substr($faker->postcode, 0, 33));
            $coordinate->setPostalLine7(substr($faker->countryCode, 0, 33));
            $manager->persist($coordinate);
        }

        $manager->flush();
    }
}
