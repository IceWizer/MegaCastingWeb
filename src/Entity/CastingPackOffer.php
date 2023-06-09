<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CastingPackOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(
            normalizationContext: [
                'groups' => ['casting_pack_offer:read'],
            ],
            security: 'true'
        ),
        new Get(
            security: 'is_granted("ROLE_ADMIN")'
        ),
        new Post(
            security: 'is_granted("ROLE_ADMIN")'
        ),
        new Put(
            security: 'is_granted("ROLE_ADMIN")'
        ),
        new Patch(
            security: 'is_granted("ROLE_ADMIN")'
        ),
        new Delete(
            security: 'is_granted("ROLE_ADMIN")'
        )
    ],
    mercure: true,
    paginationClientItemsPerPage: true,
)]
#[ORM\Entity(repositoryClass: CastingPackOfferRepository::class)]
class CastingPackOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['casting_pack_offer:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['casting_pack_offer:read'])]
    private ?string $label = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['casting_pack_offer:read'])]
    private ?string $price = null;

    #[ORM\Column]
    #[Groups(['casting_pack_offer:read'])]
    private ?int $duration = null;

    #[ORM\Column]
    #[Groups(['casting_pack_offer:read'])]
    private ?int $castingNumber = null;

    #[ORM\OneToMany(mappedBy: 'castingPackOffer', targetEntity: CustomerPacks::class, orphanRemoval: true)]
    private Collection $customerPacks;

    public function __construct()
    {
        $this->customerPacks = new ArrayCollection();
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getCastingNumber(): ?int
    {
        return $this->castingNumber;
    }

    public function setCastingNumber(int $castingNumber): self
    {
        $this->castingNumber = $castingNumber;

        return $this;
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
            $customerPack->setCastingPackOffer($this);
        }

        return $this;
    }

    public function removeCustomerPack(CustomerPacks $customerPack): self
    {
        if ($this->customerPacks->removeElement($customerPack)) {
            // set the owning side to null (unless already changed)
            if ($customerPack->getCastingPackOffer() === $this) {
                $customerPack->setCastingPackOffer(null);
            }
        }

        return $this;
    }
}
