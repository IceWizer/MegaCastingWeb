<?php

declare(strict_types=1);

namespace App\DataTransformer;

use App\ApiResource\CastingOfferRepresentation;
use App\Entity\CastingOffer;


final class CastingOfferRepresentationDataTransformer
{
    public function __construct() { }

    public function transform(CastingOffer $value): CastingOfferRepresentation
    {
        $output = new CastingOfferRepresentation();

        $output->id = (int) $value->getId();
        $output->label = (string) $value->getLabel();
        $output->reference = (string) $value->getReference();
        $output->startPublishDate = $value->getStartPublishDate();
        $output->publicationDuration = (int) $value->getPublicationDuration();
        $output->contractStartDate = $value->getContractStartDate();
        $output->jobNumber = (int) $value->getJobNumber();
        $output->location = (string) $value->getLocation();
        $output->jobDescription = (string) $value->getJobDescription();
        $output->profilDescription = (string) $value->getProfilDescription();
        $output->coordonate = $value->getCoordonate();
        $output->sponsor = $value->isSponsor();
        $output->emergencyLevel = $value->getEmergencyLevel();
        $output->postuler = count($value->getUsers()) > 0;

        return $output;
    }
}
