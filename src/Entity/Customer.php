<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    normalizationContext: [
        'groups' => ['customer:read'],
    ],
    mercure: true,
    paginationClientItemsPerPage: true,
    security: true,
)]
#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['casting_offer:read', 'casting_offer:show', 'customer:read', 'user:show'])]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: CustomerPacks::class, orphanRemoval: true)]
    #[Groups(['customer:read'])]
    private Collection $customerPacks;

    #[ORM\OneToMany(mappedBy: 'customer', targetEntity: CastingOffer::class, orphanRemoval: true)]
    #[Groups(['customer:read'])]
    private Collection $castingOffers;

    #[ORM\Column(length: 255)]
    #[Groups(['casting_offer:read', 'casting_offer:show', 'customer:read', 'user:show'])]
    private ?string $label = null;

    public function __construct()
    {
        $this->customerPacks = new ArrayCollection();
        $this->castingOffers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, CustomerPacks>
     */
    public function getCustomerPacks(): Collection
    {
        return $this->customerPacks;
    }

    public function addCustomerPack(CustomerPacks $customerPack): self
    {
        if (!$this->customerPacks->contains($customerPack)) {
            $this->customerPacks->add($customerPack);
            $customerPack->setCustomer($this);
        }

        return $this;
    }

    public function removeCustomerPack(CustomerPacks $customerPack): self
    {
        if ($this->customerPacks->removeElement($customerPack)) {
            // set the owning side to null (unless already changed)
            if ($customerPack->getCustomer() === $this) {
                $customerPack->setCustomer(null);
            }
        }

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
            $castingOffer->setCustomer($this);
        }

        return $this;
    }

    public function removeCastingOffer(CastingOffer $castingOffer): self
    {
        if ($this->castingOffers->removeElement($castingOffer)) {
            // set the owning side to null (unless already changed)
            if ($castingOffer->getCustomer() === $this) {
                $castingOffer->setCustomer(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }
}
