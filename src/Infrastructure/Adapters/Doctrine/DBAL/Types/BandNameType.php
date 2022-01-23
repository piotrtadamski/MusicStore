<?php

namespace MusicStore\Infrastructure\Adapters\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use MusicStore\Domain\Band\BandName;

final class BandNameType extends AbstractStringType
{
    protected function handleConvertToPHPValue(string $value, AbstractPlatform $platform)
    {
        return BandName::fromString($value);
    }
}
