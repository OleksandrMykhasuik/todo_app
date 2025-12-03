<?php

namespace App\Form\DataTransformer;

use App\ValueObject\IpAddress;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class IpAddressTransformer implements DataTransformerInterface
{
    public function transform(mixed $value): mixed
    {
        if (null === $value) {
            return '';
        }

        if (!$value instanceof IpAddress) {
            throw new TransformationFailedException('Expected an IpAddress object.');
        }

        return $value->toString();
    }

    public function reverseTransform(mixed $value): mixed
    {
        if (null === $value || '' === $value) {
            return null;
        }
        try {
            return IpAddress::fromString($value);
        } catch (\InvalidArgumentException $exception) {
            throw new TransformationFailedException('invalid IP address: ' . $exception->getMessage());
        }
    }
}
