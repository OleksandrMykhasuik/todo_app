<?php

namespace App\Dto\Map;

use App\Dto\SNMPWalkResult;
use App\Enum\SNMP\OID;
use App\Lib\AbstractDtoMap;

/**
 * @method SNMPWalkResult get(OID $key)
 * @method void set(OID $key, SNMPWalkResult $value)
 */
class SNMPWalkResultMap extends AbstractDtoMap
{
    protected function getKeyValue(mixed $key): string
    {
        if (!$key instanceof OID) {
            throw new \InvalidArgumentException('key must be OID');
        }

        return $key->name;
    }

    protected function assertValue(mixed $value): void
    {
        if (!$value instanceof SNMPWalkResult) {
            throw new \InvalidArgumentException('value must be SNMPWalkResult');
        }
    }
}
