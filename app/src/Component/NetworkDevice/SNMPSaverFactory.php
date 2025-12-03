<?php

namespace App\Component\NetworkDevice;

use App\Component\Contract\NetworkDeviceSNMPDataSaverInterface;
use App\Enum\SNMP\ReadingDataType;
use Psr\Container\ContainerInterface;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class SNMPSaverFactory
{
    public function __construct(
        private readonly ContainerInterface $locator,
    ) {}

    public function get(ReadingDataType $key): NetworkDeviceSNMPDataSaverInterface
    {
        if (!$this->locator->has($key->name)) {
            throw new NotFoundResourceException('Service not found for provided key: ' . $key->name);
        }

        return $this->locator->get($key->name);
    }
}
