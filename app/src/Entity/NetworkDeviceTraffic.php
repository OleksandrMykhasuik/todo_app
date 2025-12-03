<?php

namespace App\Entity;

use App\Repository\NetworkDeviceTrafficRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NetworkDeviceTrafficRepository::class)]
class NetworkDeviceTraffic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(
        inversedBy: 'networkDeviceTraffic'
    )]
    #[ORM\JoinColumn(nullable: false)]
    private ?NetworkDeviceEntity $networkDeviceId = null;

    #[ORM\Column(length: 255)]
    private ?string $ethernetInterfaceName = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $trafficIn = null;

    #[ORM\Column(type: Types::BIGINT, nullable: true)]
    private ?string $trafficOut = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $fetchedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNetworkDeviceId(): ?NetworkDeviceEntity
    {
        return $this->networkDeviceId;
    }

    public function setNetworkDeviceId(?NetworkDeviceEntity $networkDeviceId): static
    {
        $this->networkDeviceId = $networkDeviceId;

        return $this;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getEthernetInterfaceName(): ?string
    {
        return $this->ethernetInterfaceName;
    }

    public function setEthernetInterfaceName(string $ethernetInterfaceName): static
    {
        $this->ethernetInterfaceName = $ethernetInterfaceName;

        return $this;
    }

    public function getTrafficIn(): ?string
    {
        return $this->trafficIn;
    }

    public function setTrafficIn(?string $trafficIn): static
    {
        $this->trafficIn = $trafficIn;

        return $this;
    }

    public function getTrafficOut(): ?string
    {
        return $this->trafficOut;
    }

    public function setTrafficOut(?string $trafficOut): static
    {
        $this->trafficOut = $trafficOut;

        return $this;
    }

    public function getFetchedAt(): ?\DateTimeImmutable
    {
        return $this->fetchedAt;
    }

    public function setFetchedAt(\DateTimeImmutable $fetchedAt): static
    {
        $this->fetchedAt = $fetchedAt;

        return $this;
    }
}
