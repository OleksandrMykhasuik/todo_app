<?php

namespace App\Component\NetworkDevice;

use App\Component\SNMP\Walker;
use App\Dictionary\SnmpOidGroupDictionary;
use App\Dto\Map\SNMPWalkResultMap;
use App\Entity\NetworkDeviceEntity;
use App\Enum\SNMP\ReadingDataType;
use App\ValueObject\Hostname;

class NetworkDeviceSNMPReader
{
    private const SNMP_COMMUNITY_NAME = 'common';

    public function __construct(
        private readonly Walker $SNMPWalker,
        private readonly SNMPSaverFactory $SNMPSaverFactory,
        private readonly SnmpOidGroupDictionary $snmpOidGroupDictionary,
    ) {
    }

    public function refreshSnmpData(NetworkDeviceEntity $networkDeviceEntity, ReadingDataType $dataType): NetworkDeviceEntity
    {
        $snmpWalkResultMap = new SNMPWalkResultMap();
        foreach ($this->snmpOidGroupDictionary->getOids($dataType) as $oid) {
            $snmpWalkerResult = $this->SNMPWalker->grabData(
                new Hostname($networkDeviceEntity->getIpAddress()->toString()),
                self::SNMP_COMMUNITY_NAME,
                $oid,
            );
            $snmpWalkResultMap->set($oid, $snmpWalkerResult);
        }
        $networkDeviceEntity = $this->SNMPSaverFactory->get($dataType)->save($snmpWalkResultMap, $networkDeviceEntity);

        return $networkDeviceEntity;
    }
}
