<?php

namespace MusicStore\Infrastructure\Adapters\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use MusicStore\Domain\Common\Types\Url;

final class UrlType extends AbstractStringType
{
    protected function handleConvertToPHPValue(string $value, AbstractPlatform $platform)
    {
        return Url::fromString($value);
    }
}