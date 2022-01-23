<?php

namespace MusicStore\Application\Command\Album;

class DeleteAlbum
{
    private int $albumId;

    public function __construct(int $albumId)
    {
        $this->albumId = $albumId;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }
}