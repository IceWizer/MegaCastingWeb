<?php

namespace App\DataFixtures;

use App\Entity\CastingPackOffer;
use App\Entity\Customer;
use App\Entity\CustomerPacks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CustomerPacksFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $packs = $manager->getRepository(CastingPackOffer::class)->findAll();
        $customers = $manager->getRepository(Customer::class)->findAll();

        // Create 0 to 5 packs for each customer
        foreach ($customers as $customer) {
            for ($i = 0; $i < random_int(0, 5); $i++) {
                $customerPack = new CustomerPacks();

                $customerPack->setCustomer($customer);

                $pack = $packs[array_rand($packs)];
                $customerPack->setCastingPackOffer($pack);
                $customerPack->setPrice($pack->getPrice());

                $manager->persist($customerPack);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CustomerFixtures::class,
            CastingPackOfferFixtures::class,
        ];
    }
}
