<?php

namespace MusicStore\Application\Command\Band;

class DeleteBand
{
    private int $bandId;

    public function __construct(int $bandId)
    {
        $this->bandId = $bandId;
    }

    public function getBandId(): int
    {
        return $this->bandId;
    }
}