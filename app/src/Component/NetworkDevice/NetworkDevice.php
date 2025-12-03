<?php

namespace App\Component\NetworkDevice;

use App\Enum\SNMP\ReadingDataType;
use App\Repository\Contract\NetworkDeviceEntityRepositoryInterface;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class NetworkDevice
{
    public function __construct(
        private readonly NetworkDeviceSNMPReader $networkDeviceSNMPReader,
        private readonly NetworkDeviceEntityRepositoryInterface $networkDeviceEntityRepository,
    ) {
    }
    public function refreshDataFromSnmp(int $networkDeviceId, ReadingDataType $readingDataType): void
    {
        $entity = $this->networkDeviceEntityRepository->findById($networkDeviceId);
        if (\is_null($entity)) {
            throw new NotFoundResourceException('Network device not found');
        }
        try {
            $this->networkDeviceSNMPReader->refreshSnmpData($entity, $readingDataType);
            $this->networkDeviceEntityRepository->save($entity);
        } catch (\Throwable $exception) {
            $this->networkDeviceEntityRepository->refresh($entity);
            throw $exception;
        }
    }
}
