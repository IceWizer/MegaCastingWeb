<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CastingOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    mercure: true,
    paginationClientItemsPerPage: true,
)]
#[ORM\Entity(repositoryClass: CastingOfferRepository::class)]
class CastingOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $startPublishDate = null;

    #[ORM\Column]
    private ?int $publicationDuration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $contractStartDate = null;

    #[ORM\Column]
    private ?int $jobNumber = null;

    #[ORM\Column(length: 4096)]
    private ?string $location = null;

    #[ORM\Column(length: 4096)]
    private ?string $jobDescription = null;

    #[ORM\Column(length: 4096)]
    private ?string $profilDescription = null;

    #[ORM\ManyToOne(inversedBy: 'castingOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Coordonate $coordonate = null;

    #[ORM\ManyToOne(inversedBy: 'castingOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ContractType $contractType = null;

    #[ORM\ManyToMany(targetEntity: Job::class, inversedBy: 'castingOffers')]
    private Collection $jobs;

    #[ORM\OneToMany(mappedBy: 'castingOffer', targetEntity: Observer::class, orphanRemoval: true)]
    private Collection $observers;

    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->observers = new ArrayCollection();
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
}
