<?php


namespace App\EntityRepresentation;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\EntityRepresentation\CastingOfferRepresentation;
use App\Entity\CastingOffer;
use App\Repository\CastingOfferRepository;

final class CastingOfferRepresentationProcessor implements ProcessorInterface
{
    private CastingOfferRepository $castingOfferRepository;

    public function __construct(CastingOfferRepository $castingOfferRepository)
    {
        $this->castingOfferRepository = $castingOfferRepository;
    }

    /**
     * @param CastingOffer $data
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $postuler = $this->castingOfferRepository->isPostuler($data, null);

        return new CastingOfferRepresentation(
            $data->getId(),
            $data->getLabel(),
            $data->getReference(),
            $data->getStartPublishDate(),
            $data->getPublicationDuration(),
            $data->getContractStartDate(),
            $data->getJobNumber(),
            $data->getLocation(),
            $data->getJobDescription(),
            $data->getProfilDescription(),
            $data->getCoordonate(),
            $data->getCustomer(),
            $data->getContractType(),
            $data->getJobs(),
            $data->getObservers(),
            $data->getUsers(),
            $data->isSponsor(),
            $data->getEmergencyLevel(),
            $postuler
        );
    }
}
