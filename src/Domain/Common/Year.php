<?php

namespace MusicStore\Domain\Common;

class Year
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
}