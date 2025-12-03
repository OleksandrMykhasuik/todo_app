<?php

namespace App\Component\SNMP;

use App\Dto\SNMPWalkResult;
use App\Enum\SNMP\OID;
use App\ValueObject\Hostname;

class Walker
{
    public function grabData(Hostname $hostname, string $communityName, OID $objectId)
    {
        $snmpResult = \snmp2_real_walk($hostname->name, $communityName, $objectId->value);

        return new SNMPWalkResult($snmpResult);
    }
}
