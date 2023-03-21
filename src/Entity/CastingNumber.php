<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CastingNumberRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    mercure: true,
    paginationClientItemsPerPage: true,
    security: 'is_granted("ROLE_ADMIN")',
)]
#[ORM\Entity(repositoryClass: CastingNumberRepository::class)]
class CastingNumber
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $castingNumber = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }
}
