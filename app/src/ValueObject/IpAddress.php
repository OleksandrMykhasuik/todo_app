<?php

namespace App\ValueObject;

use function PHPUnit\Framework\throwException;

final class IpAddress
{
    private function __construct(private int $long)
    {
    }

    public static function fromString(string $ipAddress): self
    {
        $long = ip2long($ipAddress);
        if ($long === false) {
            throw new \InvalidArgumentException('Invalid IP address: ' . $ipAddress);
        }
        return new self($long);
    }

    public static function fromInt(int $long): self
    {
        return new self($long);
    }

    public function toString(): string
    {
        return \long2ip($this->long);
    }

    public function toInt(): int
    {
        return $this->long;
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}
