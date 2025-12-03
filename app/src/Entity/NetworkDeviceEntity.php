<?php

namespace App\Entity;

use App\Doctrine\Types\IpAddressType;
use App\Repository\Db\NetworkDeviceEntityRepository;
use App\ValueObject\IpAddress;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NetworkDeviceEntityRepository::class)]
class NetworkDeviceEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, NetworkDeviceSummary>
     */
    #[ORM\OneToMany(
        targetEntity: NetworkDeviceSummary::class,
        mappedBy: 'networkDeviceId',
        cascade: ['persist', 'remove'],
        orphanRemoval: true,
    )]
    private Collection $networkDeviceSummary;

    /**
     * @var Collection<int, NetworkDeviceTraffic>
     */
    #[ORM\OneToMany(
        targetEntity: NetworkDeviceTraffic::class,
        mappedBy: 'networkDeviceId',
        cascade: ['persist', 'remove'],
        orphanRemoval: true,
    )]
    private Collection $networkDeviceTraffic;

    #[ORM\Column(type: IpAddressType::NAME)]
    private ?IpAddress $ipAddress = null;

    public function __construct()
    {
        $this->networkDeviceSummary = new ArrayCollection();
        $this->networkDeviceTraffic = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, NetworkDeviceSummary>
     */
    public function getNetworkDeviceSummary(): Collection
    {
        return $this->networkDeviceSummary;
    }

    public function addNetworkDeviceSummary(NetworkDeviceSummary $networkDeviceSummary): static
    {
        if (!$this->networkDeviceSummary->contains($networkDeviceSummary)) {
            $this->networkDeviceSummary->add($networkDeviceSummary);
            $networkDeviceSummary->setNetworkDeviceId($this);
        }

        return $this;
    }

    public function removeNetworkDeviceSummary(NetworkDeviceSummary $networkDeviceSummary): static
    {
        if ($this->networkDeviceSummary->removeElement($networkDeviceSummary)) {
            // set the owning side to null (unless already changed)
            if ($networkDeviceSummary->getNetworkDeviceId() === $this) {
                $networkDeviceSummary->setNetworkDeviceId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, NetworkDeviceTraffic>
     */
    public function getNetworkDeviceTraffic(): Collection
    {
        return $this->networkDeviceTraffic;
    }

    public function addNetworkDeviceTraffic(NetworkDeviceTraffic $networkDeviceTraffic): static
    {
        if (!$this->networkDeviceTraffic->contains($networkDeviceTraffic)) {
            $this->networkDeviceTraffic->add($networkDeviceTraffic);
            $networkDeviceTraffic->setNetworkDeviceId($this);
        }

        return $this;
    }

    public function removeNetworkDeviceTraffic(NetworkDeviceTraffic $networkDeviceTraffic): static
    {
        if ($this->networkDeviceTraffic->removeElement($networkDeviceTraffic)) {
            // set the owning side to null (unless already changed)
            if ($networkDeviceTraffic->getNetworkDeviceId() === $this) {
                $networkDeviceTraffic->setNetworkDeviceId(null);
            }
        }

        return $this;
    }

    public function getIpAddress(): ?IpAddress
    {
        return $this->ipAddress;
    }

    public function setIpAddress(IpAddress $ipAddress): static
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }
}
