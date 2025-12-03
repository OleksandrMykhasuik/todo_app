<?php

namespace App\Entity;

use App\Repository\NetworkDeviceSummaryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NetworkDeviceSummaryRepository::class)]
class NetworkDeviceSummary
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'networkDeviceSummary')]
    #[ORM\JoinColumn(nullable: false)]
    private ?NetworkDeviceEntity $networkDeviceId = null;

    #[ORM\Column(nullable: true)]
    private ?int $temperatureC = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $CPULoadPercent = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $fetchedAt = null;

    #[ORM\Column]
    private ?int $RAMUsage = null;

    #[ORM\Column]
    private ?int $uptime = null;

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

    public function getTemperatureC(): ?int
    {
        return $this->temperatureC;
    }

    public function setTemperatureC(?int $temperatureC): static
    {
        $this->temperatureC = $temperatureC;

        return $this;
    }

    public function getCPULoadPercent(): ?int
    {
        return $this->CPULoadPercent;
    }

    public function setCPULoadPercent(int $CPULoadPercent): static
    {
        $this->CPULoadPercent = $CPULoadPercent;

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

    public function getRAMUsage(): ?int
    {
        return $this->RAMUsage;
    }

    public function setRAMUsage(int $RAMUsage): static
    {
        $this->RAMUsage = $RAMUsage;

        return $this;
    }

    public function getUptime(): ?int
    {
        return $this->uptime;
    }

    public function setUptime(int $uptime): static
    {
        $this->uptime = $uptime;

        return $this;
    }
}
