<?php

namespace MusicStore\Domain\Common\Types;

class Year  implements \JsonSerializable
{
    private string $year;

    public function __construct(string $year)
    {
        $this->year = $year;
    }

    public static function fromString(string $value)
    {
        return new self($value);
    }

    public function __toString()
    {
        return $this->year;
    }

    public function jsonSerialize()
    {
        return $this->year;
    }
}