<?php

namespace App\DataFixtures;

use App\Entity\EmergencyLevel;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EmergencyLevelFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create 4 emergency levels

        $level1 = new EmergencyLevel();
        $level1->setLabel('Low');
        $level1->setLevel(1);
        $manager->persist($level1);

        $level2 = new EmergencyLevel();
        $level2->setLabel('Medium');
        $level2->setLevel(2);
        $manager->persist($level2);

        $level3 = new EmergencyLevel();
        $level3->setLabel('High');
        $level3->setLevel(3);
        $manager->persist($level3);

        $level4 = new EmergencyLevel();
        $level4->setLabel('Critical');
        $level4->setLevel(4);
        $manager->persist($level4);

        $manager->flush();
    }
}
