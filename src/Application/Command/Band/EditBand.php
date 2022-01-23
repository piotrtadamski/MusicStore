<?php

namespace MusicStore\Application\Command\Band;

class EditBand
{
    private int $bandId;
    private string $bandName;

    public function __construct(int $bandId, string $bandName)
    {
        $this->bandId = $bandId;
        $this->bandName = $bandName;
    }

    public function getBandId(): int
    {
        return $this->bandId;
    }

    public function getBandName(): string
    {
        return $this->bandName;
    }
}