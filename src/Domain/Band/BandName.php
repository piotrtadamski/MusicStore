<?php

namespace MusicStore\Domain\Band;

class BandName
{
    private string $bandName;

    public function __construct(string $bandName)
    {
        $this->bandName = $bandName;
    }

    public static function fromString(string $value)
    {
        return new self($value);
    }

    public function __toString()
    {
        return $this->bandName;
    }
}