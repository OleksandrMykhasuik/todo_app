<?php

namespace App\Component\NetworkDevice;

use App\Component\Contract\NetworkDeviceSNMPDataSaverInterface;
use App\Component\SNMP\OIDValueParser;
use App\Dto\Map\SNMPWalkResultMap;
use App\Entity\NetworkDeviceEntity;
use App\Entity\NetworkDeviceTraffic;
use App\Enum\SNMP\OID;

class TrafficSNMPSaver implements NetworkDeviceSNMPDataSaverInterface
{
    public function __construct(
        private readonly OIDValueParser $oidValueParser,
    ) {
    }
    public function save(SNMPWalkResultMap $SNMPWalkResultMap, NetworkDeviceEntity $networkDeviceEntity): NetworkDeviceEntity
    {
        $now = new \DateTimeImmutable();

        $interfaces = \array_values($SNMPWalkResultMap->get(OID::OID_ifDescr)->content);
        $trafficIn = \array_values($SNMPWalkResultMap->get(OID::OID_ifHCIn)->content);
        $trafficOut = \array_values($SNMPWalkResultMap->get(OID::OID_ifHCOut)->content);
        foreach ($interfaces as $index => $interface) {
            $interfaceInTraffic = $this->oidValueParser->parseNetworkCounterValue($trafficIn[$index]);
            $interfaceOutTraffic = $this->oidValueParser->parseNetworkCounterValue($trafficOut[$index]);

            $networkDeviceTraffic = new NetworkDeviceTraffic();
            $networkDeviceTraffic->setFetchedAt($now);
            $networkDeviceTraffic->setEthernetInterfaceName($this->oidValueParser->parseStringValue($interface));
            $networkDeviceTraffic->setTrafficIn($interfaceInTraffic);
            $networkDeviceTraffic->setTrafficOut($interfaceOutTraffic);

            $networkDeviceEntity->addNetworkDeviceTraffic($networkDeviceTraffic);
        }

        return $networkDeviceEntity;
    }
}
