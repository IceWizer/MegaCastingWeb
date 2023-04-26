<?php

namespace App\DataFixtures;

use App\Entity\CastingOffer;
use App\Entity\ContractType;
use App\Entity\Coordonate;
use App\Entity\Customer;
use App\Entity\EmergencyLevel;
use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CastingOfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $coordinates = $manager->getRepository(Coordonate::class)->findAll();
        $customers = $manager->getRepository(Customer::class)->findAll();
        $contractTypes = $manager->getRepository(ContractType::class)->findAll();
        $jobs = $manager->getRepository(Job::class)->findAll();
        $emergencyLevels = $manager->getRepository(EmergencyLevel::class)->findAll();

        // Create 1000 casting offers
        for ($i = 0; $i < 1000; $i++) {
            $castingOffer = new CastingOffer();
            $castingOffer->setLabel($faker->sentence(3));
            $castingOffer->setJobDescription($faker->paragraph(3));
            $castingOffer->setProfilDescription($faker->paragraph(3));
            $castingOffer->setLocation($faker->city);
            $castingOffer->setReference($faker->uuid);
            $castingOffer->setCustomer($customers[array_rand($customers)]);
            $castingOffer->setContractType($contractTypes[array_rand($contractTypes)]);
            $castingOffer->setJobNumber($faker->numberBetween(1, 10));
            $castingOffer->setStartPublishDate($faker->dateTimeBetween('-1 years', 'now'));
            $castingOffer->setPublicationDuration($faker->numberBetween(1, 30));
            $castingOffer->setContractStartDate($faker->dateTimeBetween('-1 years', 'now'));
            $castingOffer->setCoordonate($coordinates[$i % (count($coordinates) || 1)]);
            $castingOffer->addJob($jobs[array_rand($jobs)]);
            $castingOffer->setSponsor($faker->boolean(5));
            $castingOffer->setEmergencyLevel($emergencyLevels[array_rand($emergencyLevels)]);
            $manager->persist($castingOffer);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class,
            ContractTypeFixtures::class,
            CoordonateFixtures::class,
            JobFixtures::class,
            EmergencyLevelFixtures::class,
        ];
    }
}
