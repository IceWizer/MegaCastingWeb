<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ContractTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    mercure: true,
    paginationClientItemsPerPage: true,
    security: 'is_granted("ROLE_ADMIN")',
)]
#[ORM\Entity(repositoryClass: ContractTypeRepository::class)]
class ContractType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $labelLong = null;

    #[ORM\Column(length: 255)]
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
