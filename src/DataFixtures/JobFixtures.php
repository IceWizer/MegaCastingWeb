<?php

namespace App\DataFixtures;

use App\Entity\Job;
use App\Entity\JobDomain;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class JobFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $jobDomains = $manager->getRepository(JobDomain::class)->findAll();

        // Create 1000 jobs
        for ($i = 0; $i < 1000; $i++) {
            $jbb = [];

            // Get 0 to 5 unique job domains for each job
            for ($j = 0; $j < random_int(0, 5); $j++) {
                $jbb[] = array_rand($jobDomains);
            }
            $jbb = array_unique($jbb, SORT_NUMERIC);

            $job = new Job();
            $job->setLabel($faker->jobTitle);
            foreach ($jbb as $jobDomain) {
                $job->addJobDomain($jobDomains[$jobDomain]);
            }
            $manager->persist($job);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            JobDomainFixtures::class,
        ];
    }
}
