<?php

namespace MusicStore\Application\Command\Band;

class AddBand
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
}