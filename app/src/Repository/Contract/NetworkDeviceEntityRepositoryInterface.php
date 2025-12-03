<?php

namespace App\Repository\Contract;

use App\Entity\NetworkDeviceEntity;

interface NetworkDeviceEntityRepositoryInterface
{
    public function findById(int $id): ?NetworkDeviceEntity;
    public function save(NetworkDeviceEntity $networkDeviceEntity): void;

    public function refresh(NetworkDeviceEntity $networkDeviceEntity): void;
}
