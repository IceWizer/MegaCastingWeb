<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CoordonateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    mercure: true,
    paginationClientItemsPerPage: true,
)]
#[Put(security: "is_granted('ROLE_ADMIN')")]
#[Post(security: "is_granted('ROLE_ADMIN')")]
#[ORM\Entity(repositoryClass: CoordonateRepository::class)]
class Coordonate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['casting_offer:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['casting_offer:read'])]
    private ?string $webSite = null;

    #[ORM\Column(length: 255)]
    #[Groups(['casting_offer:read'])]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    #[Groups(['casting_offer:read'])]
    private ?string $phoneNumber = null;

    #[ORM\Column(length: 20)]
    #[Groups(['casting_offer:read'])]
    private ?string $FaxNumber = null;

    #[ORM\Column(length: 34)]
    #[Groups(['casting_offer:read'])]
    private ?string $PostalLine1 = null;

    #[ORM\Column(length: 34)]
    #[Groups(['casting_offer:read'])]
    private ?string $PostalLine2 = null;

    #[ORM\Column(length: 34)]
    #[Groups(['casting_offer:read'])]
    private ?string $PostalLine3 = null;

    #[ORM\Column(length: 34)]
    #[Groups(['casting_offer:read'])]
    private ?string $PostalLine4 = null;

    #[ORM\Column(length: 34)]
    #[Groups(['casting_offer:read'])]
    private ?string $PostalLine5 = null;

    #[ORM\Column(length: 34)]
    #[Groups(['casting_offer:read'])]
    private ?string $PostalLine6 = null;

    #[ORM\Column(length: 34)]
    #[Groups(['casting_offer:read'])]
    private ?string $PostalLine7 = null;

    #[ORM\OneToMany(mappedBy: 'coordonate', targetEntity: CastingOffer::class)]
    private Collection $castingOffers;

    public function __construct()
    {
        $this->castingOffers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebSite(): ?string
    {
        return $this->webSite;
    }

    public function setWebSite(string $webSite): self
    {
        $this->webSite = $webSite;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function getFaxNumber(): ?string
    {
        return $this->FaxNumber;
    }

    public function setFaxNumber(string $FaxNumber): self
    {
        $this->FaxNumber = $FaxNumber;

        return $this;
    }

    public function getPostalLine1(): ?string
    {
        return $this->PostalLine1;
    }

    public function setPostalLine1(string $PostalLine1): self
    {
        $this->PostalLine1 = $PostalLine1;

        return $this;
    }

    public function getPostalLine2(): ?string
    {
        return $this->PostalLine2;
    }

    public function setPostalLine2(string $PostalLine2): self
    {
        $this->PostalLine2 = $PostalLine2;

        return $this;
    }

    public function getPostalLine3(): ?string
    {
        return $this->PostalLine3;
    }

    public function setPostalLine3(string $PostalLine3): self
    {
        $this->PostalLine3 = $PostalLine3;

        return $this;
    }

    public function getPostalLine4(): ?string
    {
        return $this->PostalLine4;
    }

    public function setPostalLine4(string $PostalLine4): self
    {
        $this->PostalLine4 = $PostalLine4;

        return $this;
    }

    public function getPostalLine5(): ?string
    {
        return $this->PostalLine5;
    }

    public function setPostalLine5(string $PostalLine5): self
    {
        $this->PostalLine5 = $PostalLine5;

        return $this;
    }

    public function getPostalLine6(): ?string
    {
        return $this->PostalLine6;
    }

    public function setPostalLine6(string $PostalLine6): self
    {
        $this->PostalLine6 = $PostalLine6;

        return $this;
    }

    public function getPostalLine7(): ?string
    {
        return $this->PostalLine7;
    }

    public function setPostalLine7(string $PostalLine7): self
    {
        $this->PostalLine7 = $PostalLine7;

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
            $castingOffer->setCoordonate($this);
        }

        return $this;
    }

    public function removeCastingOffer(CastingOffer $castingOffer): self
    {
        if ($this->castingOffers->removeElement($castingOffer)) {
            // set the owning side to null (unless already changed)
            if ($castingOffer->getCoordonate() === $this) {
                $castingOffer->setCoordonate(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
