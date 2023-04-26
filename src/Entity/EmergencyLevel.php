<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EmergencyLevelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmergencyLevelRepository::class)]
#[ApiResource]
class EmergencyLevel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\OneToMany(mappedBy: 'emergencyLevel', targetEntity: CastingOffer::class)]
    private Collection $castingOffers;

    public function __construct()
    {
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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

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
            $castingOffer->setEmergencyLevel($this);
        }

        return $this;
    }

    public function removeCastingOffer(CastingOffer $castingOffer): self
    {
        if ($this->castingOffers->removeElement($castingOffer)) {
            // set the owning side to null (unless already changed)
            if ($castingOffer->getEmergencyLevel() === $this) {
                $castingOffer->setEmergencyLevel(null);
            }
        }

        return $this;
    }
}
