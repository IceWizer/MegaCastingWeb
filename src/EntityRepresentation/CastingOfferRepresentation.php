<?php

namespace App\EntityRepresentation;

use ApiPlatform\Metadata\ApiResource;
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
    normalizationContext: [
        'groups' => ['casting_offer:read'],
    ],
    mercure: true,
    paginationClientItemsPerPage: true,
)]
class CastingOfferRepresentation
{
    #[Groups(['casting_offer:show'])]
    private ?int $id = null;
    #[Groups(['casting_offer:show'])]
    private ?string $label = null;
    #[Groups(['casting_offer:show'])]
    private ?string $reference = null;
    #[Groups(['casting_offer:show'])]
    private ?\DateTimeInterface $startPublishDate = null;
    #[Groups(['casting_offer:show'])]
    private ?int $publicationDuration = null;
    #[Groups(['casting_offer:show'])]
    private ?\DateTimeInterface $contractStartDate = null;
    #[Groups(['casting_offer:show'])]
    private ?int $jobNumber = null;
    #[Groups(['casting_offer:show'])]
    private ?string $location = null;
    #[Groups(['casting_offer:show'])]
    private ?string $jobDescription = null;
    #[Groups(['casting_offer:show'])]
    private ?string $profilDescription = null;
    #[Groups(['casting_offer:show'])]
    private ?Coordonate $coordonate = null;
    #[Groups(['casting_offer:show'])]
    private ?Customer $customer = null;
    #[Groups(['casting_offer:show'])]
    private ?ContractType $contractType = null;
    #[Groups(['casting_offer:show'])]
    private Collection $jobs;
    #[Groups(['casting_offer:show'])]
    private Collection $observers;
    #[Groups(['casting_offer:show'])]
    private Collection $users;
    #[Groups(['casting_offer:show'])]
    private ?bool $sponsor = null;
    #[Groups(['casting_offer:show'])]
    private ?EmergencyLevel $emergencyLevel = null;
    #[Groups(['casting_offer:show'])]

    private ?bool $postuler = null;

    public function __construct(
        $id,
        $label,
        $reference,
        $startPublishDate,
        $publicationDuration,
        $contractStartDate,
        $jobNumber,
        $location,
        $jobDescription,
        $profilDescription,
        $coordonate,
        $customer,
        $contractType,
        $jobs,
        $observers,
        $users,
        $sponsor,
        $emergencyLevel,
        $postuler
    ) {
        $this->id = $id;
        $this->label = $label;
        $this->reference = $reference;
        $this->startPublishDate = $startPublishDate;
        $this->publicationDuration = $publicationDuration;
        $this->contractStartDate = $contractStartDate;
        $this->jobNumber = $jobNumber;
        $this->location = $location;
        $this->jobDescription = $jobDescription;
        $this->profilDescription = $profilDescription;
        $this->coordonate = $coordonate;
        $this->customer = $customer;
        $this->contractType = $contractType;
        $this->jobs = $jobs;
        $this->observers = $observers;
        $this->users = $users;
        $this->sponsor = $sponsor;
        $this->emergencyLevel = $emergencyLevel;
        $this->postuler = $postuler;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function getStartPublishDate(): ?\DateTimeInterface
    {
        return $this->startPublishDate;
    }

    public function getPublicationDuration(): ?int
    {
        return $this->publicationDuration;
    }

    public function getContractStartDate(): ?\DateTimeInterface
    {
        return $this->contractStartDate;
    }

    public function getJobNumber(): ?int
    {
        return $this->jobNumber;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function getJobDescription(): ?string
    {
        return $this->jobDescription;
    }

    public function getProfilDescription(): ?string
    {
        return $this->profilDescription;
    }

    public function getCoordonate(): ?Coordonate
    {
        return $this->coordonate;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function getContractType(): ?ContractType
    {
        return $this->contractType;
    }

    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function getObservers(): Collection
    {
        return $this->observers;
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function getSponsor(): ?bool
    {
        return $this->sponsor;
    }

    public function getEmergencyLevel(): ?EmergencyLevel
    {
        return $this->emergencyLevel;
    }

    public function getPostuler(): ?bool
    {
        return $this->postuler;
    }
}
