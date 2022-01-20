<?php

namespace MusicStore\Infrastructure\Adapters\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use MusicStore\Domain\Common\Year;

final class YearType extends AbstractStringType
{
    protected function handleConvertToPHPValue(string $value, AbstractPlatform $platform)
    {
        return Year::fromString($value);
    }
}
