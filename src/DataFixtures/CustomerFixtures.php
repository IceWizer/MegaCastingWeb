<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CustomerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Create 500 customers
        for ($i = 0; $i < 500; $i++) {
            $customer = new Customer();
            $customer->setLabel($faker->company);
            $manager->persist($customer);
        }

        $manager->flush();
    }
}
