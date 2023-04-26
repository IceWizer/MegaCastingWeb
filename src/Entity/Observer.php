<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ObserverRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(
    mercure: true,
    paginationClientItemsPerPage: true,
    security: 'is_granted("ROLE_ADMIN")',
)]
#[ORM\Entity(repositoryClass: ObserverRepository::class)]
class Observer
{
    #[ORM\Column]
    private ?int $viewCount = null;

    #[ORM\Column]
    private ?int $detailCount = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'observers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CastingOffer $castingOffer = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'observers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BroadcastPartner $broadcastPartner = null;

    public function getViewCount(): ?int
    {
        return $this->viewCount;
    }

    public function setViewCount(int $viewCount): self
    {
        $this->viewCount = $viewCount;

        return $this;
    }

    public function getDetailCount(): ?int
    {
        return $this->detailCount;
    }

    public function setDetailCount(int $detailCount): self
    {
        $this->detailCount = $detailCount;

        return $this;
    }

    public function getCastingOffer(): ?CastingOffer
    {
        return $this->castingOffer;
    }

    public function setCastingOffer(?CastingOffer $castingOffer): self
    {
        $this->castingOffer = $castingOffer;

        return $this;
    }

    public function getBroadcastPartner(): ?BroadcastPartner
    {
        return $this->broadcastPartner;
    }

    public function setBroadcastPartner(?BroadcastPartner $broadcastPartner): self
    {
        $this->broadcastPartner = $broadcastPartner;

        return $this;
    }
}
