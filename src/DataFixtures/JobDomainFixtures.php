<?php

namespace App\DataFixtures;

use App\Entity\JobDomain;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class JobDomainFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Create 100 job domains
        for ($i = 0; $i < 100; $i++) {
            $jobDomain = new JobDomain();
            $jobDomain->setLabel($faker->jobTitle);
            $manager->persist($jobDomain);
        }

        $manager->flush();
    }
}
