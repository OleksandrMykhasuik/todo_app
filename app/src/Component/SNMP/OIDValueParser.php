<?php

namespace App\Component\SNMP;

class OIDValueParser
{
    public function parseIntegerValue(string $value): int
    {
        if (preg_match('/INTEGER: (\d+)/', $value, $matches)) {
            return (int) $matches[1];
        }
        throw new \UnexpectedValueException("Value '$value' is not a valid OID integer");
    }

    public function parseTemperatureValue(string $value): int
    {
        return $this->parseIntegerValue($value) / 10;
    }

    public function parseNetworkCounterValue(string $value): int
    {
        if (preg_match('/Counter64: (\d+)/', $value, $matches)) {
            return (int) $matches[1];
        }
        throw new \UnexpectedValueException("Value '$value' is not a valid OID network counter");
    }
    public function parseUptimeValue(string $value): int
    {
        if (preg_match('/Timeticks: \((\d+)\)/', $value, $matches)) {
            return (int) $matches[1] / 100;
        }
        throw new \UnexpectedValueException("Value '$value' is not a valid OID uptime");
    }

    public function parseStringValue($value): string
    {
        if (preg_match('/STRING: "([^"]+)"/', $value, $matches)) {
            return $matches[1];
        }
        throw new \UnexpectedValueException("Value '$value' is not a valid network interface name");
    }
}
