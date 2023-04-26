<?php

namespace App\DataFixtures;

use App\Entity\ContractType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContractTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create basic ContractType

        $longLabels = ['Contrat à Durée Déterminé', 'Contrat à Durée Indéterminé', 'Alternance', 'Stage', 'Intérim'];
        $shortLabels = ['CDD', 'CDI', 'Alternance', 'Stage', 'Intérim'];

        foreach ($longLabels as $key => $longLabel) {
            $contractType = new ContractType();
            $contractType->setLabelLong($longLabel);
            $contractType->setLabelShort($shortLabels[$key]);
            $manager->persist($contractType);
        }

        $manager->flush();
    }
}
