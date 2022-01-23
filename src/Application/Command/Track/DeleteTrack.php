<?php

namespace MusicStore\Application\Command\Track;

class DeleteTrack
{
    private int $trackId;

    public function __construct(int $trackId)
    {
        $this->trackId = $trackId;
    }

    public function getTrackId(): int
    {
        return $this->trackId;
    }
}