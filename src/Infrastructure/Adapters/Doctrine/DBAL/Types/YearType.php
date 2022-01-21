<?php

namespace MusicStore\Infrastructure\Adapters\Doctrine\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use MusicStore\Domain\Common\Types\Year;

final class YearType extends AbstractStringType
{
    public const YEAR = 'YEAR(4)';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return self::YEAR;
    }

    protected function handleConvertToPHPValue(string $value, AbstractPlatform $platform)
    {
        return Year::fromString($value);
    }

    public function getName()
    {
        return self::YEAR;
    }
}
