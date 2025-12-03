<?php

namespace App\Doctrine\Types;

use App\ValueObject\IpAddress;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use function PHPUnit\Framework\throwException;

class IpAddressType extends IntegerType
{
    public const NAME = 'ip_address';

    public function getName(): string
    {
        return self::NAME;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof IpAddress) {
            throw new \InvalidArgumentException('Expected an IpAddress object.');
        }

        return $value->toInt();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return IpAddress::fromInt($value);
    }
}
