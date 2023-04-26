<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    mercure: true,
    paginationClientItemsPerPage: true,
    security: true || 'is_granted("ROLE_USER")',
)]
#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['casting_offer:read', 'casting_offer:show'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['casting_offer:read', 'casting_offer:show'])]
    private ?string $label = null;

    #[ORM\JoinColumn(name: 'job_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: JobDomain::class, inversedBy: 'jobs')]
    private Collection $jobDomains;

    #[ORM\ManyToMany(targetEntity: CastingOffer::class, mappedBy: 'jobs')]
    private Collection $castingOffers;

    public function __construct()
    {
        $this->jobDomains = new ArrayCollection();
        $this->castingOffers = new ArrayCollection();
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

    /**
     * @return Collection<int, JobDomain>
     */
    public function getJobDomains(): Collection
    {
        return $this->jobDomains;
    }

    public function addJobDomain(JobDomain $jobDomain): self
    {
        if (!$this->jobDomains->contains($jobDomain)) {
            $this->jobDomains->add($jobDomain);
        }

        return $this;
    }

    public function removeJobDomain(JobDomain $jobDomain): self
    {
        $this->jobDomains->removeElement($jobDomain);

        return $this;
    }

    /**
     * @return Collection<int, CastingOffer>
     */
    public function getCastingOffers(): Collection
    {
        return $this->castingOffers;
    }

    public function addCastingOffer(CastingOffer $castingOffer): self
    {
        if (!$this->castingOffers->contains($castingOffer)) {
            $this->castingOffers->add($castingOffer);
            $castingOffer->addJob($this);
        }

        return $this;
    }

    public function removeCastingOffer(CastingOffer $castingOffer): self
    {
        if ($this->castingOffers->removeElement($castingOffer)) {
            $castingOffer->removeJob($this);
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->label;
    }
}
