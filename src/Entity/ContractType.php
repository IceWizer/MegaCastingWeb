<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ContractTypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    mercure: true,
    paginationClientItemsPerPage: true,
    security: 'true',
)]
#[ORM\Entity(repositoryClass: ContractTypeRepository::class)]
class ContractType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['casting_offer:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['casting_offer:read'])]
    private ?string $labelLong = null;

    #[ORM\Column(length: 255)]
    #[Groups(['casting_offer:read'])]
    private ?string $labelShort = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabelLong(): ?string
    {
        return $this->labelLong;
    }

    public function setLabelLong(string $labelLong): self
    {
        $this->labelLong = $labelLong;

        return $this;
    }

    public function getLabelShort(): ?string
    {
        return $this->labelShort;
    }

    public function setLabelShort(string $labelShort): self
    {
        $this->labelShort = $labelShort;

        return $this;
    }

    public function __toString(): string
    {
        return $this->labelLong;
    }
}
