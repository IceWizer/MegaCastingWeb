<?php

namespace App\DataFixtures;

use App\Entity\CastingNumber;
use App\Entity\CastingPackOffer;
use App\Entity\Duration;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CastingPackOfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $durations = $manager->getRepository(Duration::class)->findAll();
        $numbers = $manager->getRepository(CastingNumber::class)->findAll();

        // Create 10 CastingPackOffer objects
        for ($i = 0; $i < 10; ++$i) {
            $duration = $durations[array_rand($durations)];
            $number = $numbers[array_rand($numbers)];

            $castingPackOffer = new CastingPackOffer();
            $castingPackOffer->setLabel('Casting Pack Offer '.$i);
            $castingPackOffer->setPrice($duration->getPrice() + $number->getPrice());
            $castingPackOffer->setDuration($duration->getDuration());
            $castingPackOffer->setCastingNumber($number->getCastingNumber());
            $manager->persist($castingPackOffer);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            DurationFixtures::class,
            CastingNumberFixtures::class,
        ];
    }
}
