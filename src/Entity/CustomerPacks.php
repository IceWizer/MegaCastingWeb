<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CustomerPacksRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    mercure: true,
    paginationClientItemsPerPage: true,
    security: 'is_granted("ROLE_ADMIN")',
)]
#[ORM\Entity(repositoryClass: CustomerPacksRepository::class)]
class CustomerPacks
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['casting_offer:read', 'customer:read'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(['casting_offer:read'])]
    private ?string $price = null;

    #[ORM\ManyToOne(inversedBy: 'customerPacks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\ManyToOne(inversedBy: 'customerPacks')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CastingPackOffer $castingPackOffer = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCastingPackOffer(): ?CastingPackOffer
    {
        return $this->castingPackOffer;
    }

    public function setCastingPackOffer(?CastingPackOffer $castingPackOffer): self
    {
        $this->castingPackOffer = $castingPackOffer;

        return $this;
    }
}
