<?php

namespace MusicStore\Infrastructure\Adapters\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

abstract class AbstractStringType extends StringType
{
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (is_string($value) || is_object($value) && method_exists($value, '__toString')) {
            return $this->handleConvertToPHPValue($value, $platform);
        }

        throw new \LogicException();
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (is_string($value) || is_object($value) && method_exists($value, '__toString')) {
            return (string) $value;
        }

        throw new \LogicException();
    }

    abstract protected function handleConvertToPHPValue(string $value, AbstractPlatform $platform);

}