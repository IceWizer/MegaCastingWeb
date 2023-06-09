<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Entity\CastingOffer;
use App\State\CastingOfferRepresentationProvider;
use App\Entity\ContractType;
use App\Entity\Coordonate;
use App\Entity\Customer;
use App\Entity\EmergencyLevel;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class to represent a CastingOffer entity.
 * This class is used to avoid exposing the entity to the API.
 * It is used by the CastingOfferRepresentationProcessor.
 *
 * It adds the following properties:
 * - postuler
 */
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: '/casting_offers/{id}',
            normalizationContext: ['groups' => 'casting_offer:show'],
            provider: CastingOfferRepresentationProvider::class,
            extraProperties: [
                'is_postuler' => '$object->isPostuler()',
                'entity' => CastingOffer::class,
            ],
        )
    ],
)]
class CastingOfferRepresentation
{
    #[Groups(['casting_offer:show'])]
    public ?int $id = null;
    #[Groups(['casting_offer:show'])]
    public ?string $label = null;
    #[Groups(['casting_offer:show'])]
    public ?string $reference = null;
    #[Groups(['casting_offer:show'])]
    public ?\DateTimeInterface $startPublishDate = null;
    #[Groups(['casting_offer:show'])]
    public ?int $publicationDuration = null;
    #[Groups(['casting_offer:show'])]
    public ?\DateTimeInterface $contractStartDate = null;
    #[Groups(['casting_offer:show'])]
    public ?int $jobNumber = null;
    #[Groups(['casting_offer:show'])]
    public ?string $location = null;
    #[Groups(['casting_offer:show'])]
    public ?string $jobDescription = null;
    #[Groups(['casting_offer:show'])]
    public ?string $profilDescription = null;
    #[Groups(['casting_offer:show'])]
    public ?Coordonate $coordonate = null;
    #[Groups(['casting_offer:show'])]
    private ?Customer $customer = null;
    #[Groups(['casting_offer:show'])]
    public ?ContractType $contractType = null;
    #[Groups(['casting_offer:show'])]
    public Collection $jobs;
    #[Groups(['casting_offer:show'])]
    public Collection $observers;
    #[Groups(['casting_offer:show'])]
    public Collection $users;
    #[Groups(['casting_offer:show'])]
    public ?bool $sponsor = null;
    #[Groups(['casting_offer:show'])]
    public ?EmergencyLevel $emergencyLevel = null;
    #[Groups(['casting_offer:show'])]
    public ?bool $postuler = null;

    public function __construct() { }
}
