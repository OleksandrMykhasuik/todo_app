<?php

namespace App\Component\Contract;

use App\Dto\Map\SNMPWalkResultMap;
use App\Entity\NetworkDeviceEntity;

interface NetworkDeviceSNMPDataSaverInterface
{
    public function save(
        SNMPWalkResultMap $SNMPWalkResultMap, NetworkDeviceEntity $networkDeviceEntity
    ): NetworkDeviceEntity;
}
