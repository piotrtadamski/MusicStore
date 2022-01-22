<?php

namespace MusicStore\Application\Query\Band;

class BandQueryResult
{
    private string $bandName;

    public function __construct(string $bandName)
    {
        $this->bandName = $bandName;
    }

    public function getBandName(): string
    {
        return $this->bandName;
    }

    public static function create(string $bandName)
    {
        return new static($bandName);
    }
}