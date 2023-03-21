<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    mercure: true,
    paginationClientItemsPerPage: true,
    security: 'is_granted("ROLE_ADMIN")',
)]
#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\JoinColumn(name: 'job_domain_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: JobDomain::class, inversedBy: 'jobs')]
    private Collection $jobDomain;

    #[ORM\ManyToMany(targetEntity: CastingOffer::class, mappedBy: 'jobs')]
    private Collection $castingOffers;

    public function __construct()
    {
        $this->jobDomain = new ArrayCollection();
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
    public function getJobDomain(): Collection
    {
        return $this->jobDomain;
    }

    public function addJobDomain(JobDomain $jobDomain): self
    {
        if (!$this->jobDomain->contains($jobDomain)) {
            $this->jobDomain->add($jobDomain);
        }

        return $this;
    }

    public function removeJobDomain(JobDomain $jobDomain): self
    {
        $this->jobDomain->removeElement($jobDomain);

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
