<?php

namespace App\Dictionary;

use App\Enum\Collection\OIDCollection;
use App\Enum\SNMP\OID;
use App\Enum\SNMP\ReadingDataType;

class SnmpOidGroupDictionary
{
    private const OIDS = [
        ReadingDataType::Summary->name => [
            OID::OID_SYS_CPU_LOAD,
            OID::OID_SYS_MEMORY_USED,
            OID::OID_SYS_UPTIME,
            OID::OID_SYS_TEMPERATURE
        ],
        ReadingDataType::Traffic->name => [
            OID::OID_ifHCOut,
            OID::OID_ifHCIn,
            OID::OID_ifDescr,
        ],
    ];

    public function getOids(ReadingDataType $readingDataType): OIDCollection
    {
        return new OIDCollection(...self::OIDS[$readingDataType->name]);
    }
}
