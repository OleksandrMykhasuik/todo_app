<?php

namespace App\Enum\Collection;

use App\Enum\SNMP\OID;
use App\Lib\AbstractCollection;

class OIDCollection extends AbstractCollection
{
    public function __construct(OID... $oid)
    {
        foreach ($oid as $item) {
            $this->add($item);
        }
    }
    protected function assertValue(mixed $value): void
    {
        if (!$value instanceof OID) {
            throw new \InvalidArgumentException('value must be instance of ' . OID::class);
        }
    }
}
