<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Odm\Filter\ExistsFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use App\EntityRepresentation\CastingOfferRepresentation;
use App\EntityRepresentation\CastingOfferRepresentationProcessor;
use App\Repository\CastingOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Expression;

#[ApiResource(
    normalizationContext: [
        'groups' => ['casting_offer:read'],
    ],
    mercure: true,
    paginationClientItemsPerPage: true,
)]
#[Get(
    output: CastingOfferRepresentation::class,
    processor: CastingOfferRepresentationProcessor::class,
)]
#[ORM\Entity(repositoryClass: CastingOfferRepository::class)]
class CastingOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['casting_offer:read', 'casting_offer:show', 'customer:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['casting_offer:read', 'casting_offer:show', 'customer:read'])]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    #[Groups(['casting_offer:read', 'casting_offer:show', 'customer:read'])]
    private ?string $reference = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['casting_offer:read', 'casting_offer:show', 'customer:read'])]
    private ?\DateTimeInterface $startPublishDate = null;

    #[ORM\Column]
    #[Groups(['casting_offer:read', 'casting_offer:show', 'customer:read'])]
    private ?int $publicationDuration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['casting_offer:read', 'casting_offer:show', 'customer:read'])]
    private ?\DateTimeInterface $contractStartDate = null;

    #[ORM\Column]
    #[Groups(['casting_offer:read', 'casting_offer:show', 'customer:read'])]
    private ?int $jobNumber = null;

    #[ORM\Column(length: 4096)]
    #[Groups(['casting_offer:read', 'casting_offer:show', 'customer:read'])]
    private ?string $location = null;

    #[ORM\Column(length: 4096)]
    #[Groups(['customer:read', 'casting_offer:show'])]
    private ?string $jobDescription = null;

    #[ORM\Column(length: 4096)]
    #[Groups(['customer:read', 'casting_offer:show', 'customer:show'])]
    private ?string $profilDescription = null;

    #[ORM\ManyToOne(inversedBy: 'castingOffers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['casting_offer:show'])]
    private ?Coordonate $coordonate = null;

    #[ORM\ManyToOne(inversedBy: 'castingOffers')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['casting_offer:read', 'casting_offer:show'])]
    private ?Customer $customer = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['casting_offer:read', 'casting_offer:show'])]
    private ?ContractType $contractType = null;

    #[ORM\ManyToMany(targetEntity: Job::class, inversedBy: 'castingOffers')]
    #[Groups(['casting_offer:read', 'casting_offer:show'])]
    private Collection $jobs;

    #[ORM\OneToMany(mappedBy: 'castingOffer', targetEntity: Observer::class, orphanRemoval: true)]
    private Collection $observers;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'offers')]
    private Collection $users;

    #[ORM\Column]
    #[Groups(['casting_offer:read', 'casting_offer:show', 'customer:read'])]
    private ?bool $sponsor = null;

    #[ORM\ManyToOne(inversedBy: 'castingOffers')]
    #[Groups(['casting_offer:read', 'casting_offer:show'])]
    private ?EmergencyLevel $emergencyLevel = null;

    /**
     * Dynamically added property to check if the current user has already applied to this offer.
     * @var bool|null
     */
    //#[ApiProperty(readable: true, writable: false, identifier: false)]
    #[Groups(['casting_offer:read', 'casting_offer:show'])]
    private ?bool $postuler = false;

    public function __construct(Security $security)
    {
        $this->jobs = new ArrayCollection();
        $this->observers = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getStartPublishDate(): ?\DateTimeInterface
    {
        return $this->startPublishDate;
    }

    public function setStartPublishDate(\DateTimeInterface $startPublishDate): self
    {
        $this->startPublishDate = $startPublishDate;

        return $this;
    }

    public function getPublicationDuration(): ?int
    {
        return $this->publicationDuration;
    }

    public function setPublicationDuration(int $publicationDuration): self
    {
        $this->publicationDuration = $publicationDuration;

        return $this;
    }

    public function getContractStartDate(): ?\DateTimeInterface
    {
        return $this->contractStartDate;
    }

    public function setContractStartDate(\DateTimeInterface $contractStartDate): self
    {
        $this->contractStartDate = $contractStartDate;

        return $this;
    }

    public function getJobNumber(): ?int
    {
        return $this->jobNumber;
    }

    public function setJobNumber(int $jobNumber): self
    {
        $this->jobNumber = $jobNumber;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getJobDescription(): ?string
    {
        return $this->jobDescription;
    }

    public function setJobDescription(string $jobDescription): self
    {
        $this->jobDescription = $jobDescription;

        return $this;
    }

    public function getProfilDescription(): ?string
    {
        return $this->profilDescription;
    }

    public function setProfilDescription(string $profilDescription): self
    {
        $this->profilDescription = $profilDescription;

        return $this;
    }

    public function getCoordonate(): ?Coordonate
    {
        return $this->coordonate;
    }

    public function setCoordonate(?Coordonate $coordonate): self
    {
        $this->coordonate = $coordonate;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getContractType(): ?ContractType
    {
        return $this->contractType;
    }

    public function setContractType(?ContractType $contractType): self
    {
        $this->contractType = $contractType;

        return $this;
    }

    /**
     * @return Collection<int, Job>
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs->add($job);
        }

        return $this;
    }

    public function removeJob(Job $job): self
    {
        $this->jobs->removeElement($job);

        return $this;
    }

    /**
     * @return Collection<int, Observer>
     */
    public function getObservers(): Collection
    {
        return $this->observers;
    }

    public function addObserver(Observer $observer): self
    {
        if (!$this->observers->contains($observer)) {
            $this->observers->add($observer);
            $observer->setCastingOffer($this);
        }

        return $this;
    }

    public function removeObserver(Observer $observer): self
    {
        if ($this->observers->removeElement($observer)) {
            // set the owning side to null (unless already changed)
            if ($observer->getCastingOffer() === $this) {
                $observer->setCastingOffer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addOffer($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeOffer($this);
        }

        return $this;
    }

    public function isSponsor(): ?bool
    {
        return $this->sponsor;
    }

    public function setSponsor(bool $sponsor): self
    {
        $this->sponsor = $sponsor;

        return $this;
    }

    public function getEmergencyLevel(): ?EmergencyLevel
    {
        return $this->emergencyLevel;
    }

    public function setEmergencyLevel(?EmergencyLevel $emergencyLevel): self
    {
        $this->emergencyLevel = $emergencyLevel;

        return $this;
    }

    private function isPostuler(): bool
    {
        // Get the current user
        $user = null;

        if ($user instanceof User) {
            return $this->users->contains($user);
        }

        return false;
    }
}
