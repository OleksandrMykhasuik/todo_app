<?php

namespace App\Component\NetworkDevice;

use App\Component\Contract\NetworkDeviceSNMPDataSaverInterface;
use App\Component\SNMP\OIDValueParser;
use App\Dto\Map\SNMPWalkResultMap;
use App\Entity\NetworkDeviceEntity;
use App\Entity\NetworkDeviceSummary;
use App\Enum\SNMP\OID;

class SummarySNMPSaver implements NetworkDeviceSNMPDataSaverInterface
{
    public function __construct(
        private readonly OIDValueParser $oidValueParser,
    ) {
    }
    public function save(SNMPWalkResultMap $SNMPWalkResultMap, NetworkDeviceEntity $networkDeviceEntity): NetworkDeviceEntity
    {
        $now = new \DateTimeImmutable();
        $cpuLoad = $this->oidValueParser->parseIntegerValue(
            \array_values($SNMPWalkResultMap->get(OID::OID_SYS_CPU_LOAD)->content)[0]
        );
        $memoryUsed = $this->oidValueParser->parseIntegerValue(
            \array_values($SNMPWalkResultMap->get(OID::OID_SYS_MEMORY_USED)->content)[0]
        );
        $temperatureC = $this->oidValueParser->parseTemperatureValue(
            \array_values($SNMPWalkResultMap->get(OID::OID_SYS_TEMPERATURE)->content)[0]
        );
        $uptime = $this->oidValueParser->parseUptimeValue(
            \array_values($SNMPWalkResultMap->get(OID::OID_SYS_UPTIME)->content)[0]
        );

        $networkDeviceSummary = new NetworkDeviceSummary();
        $networkDeviceSummary->setFetchedAt($now);
        $networkDeviceSummary->setCPULoadPercent($cpuLoad);
        $networkDeviceSummary->setRAMUsage($memoryUsed);
        $networkDeviceSummary->setTemperatureC($temperatureC);
        $networkDeviceSummary->setUptime($uptime);

        $networkDeviceEntity->addNetworkDeviceSummary($networkDeviceSummary);

        return $networkDeviceEntity;
    }
}
