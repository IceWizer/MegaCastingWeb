<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BroadcastPartnerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    mercure: true,
    paginationClientItemsPerPage: true,
    security: 'is_granted("ROLE_ADMIN")',
)]
#[ORM\Entity(repositoryClass: BroadcastPartnerRepository::class)]
class BroadcastPartner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'broadcastPartner', targetEntity: Observer::class, orphanRemoval: true)]
    private Collection $observers;

    public function __construct()
    {
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
            $observer->setBroadcastPartner($this);
        }

        return $this;
    }

    public function removeObserver(Observer $observer): self
    {
        if ($this->observers->removeElement($observer)) {
            // set the owning side to null (unless already changed)
            if ($observer->getBroadcastPartner() === $this) {
                $observer->setBroadcastPartner(null);
            }
        }

        return $this;
    }
}
