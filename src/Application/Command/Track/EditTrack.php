<?php

namespace MusicStore\Application\Command\Track;

class EditTrack
{
    private int $trackId;
    private int $albumId;
    private string $title;
    private string $url;

    public function __construct(int $trackId, int $albumId, string $title, string $url)
    {
        $this->trackId = $trackId;
        $this->albumId = $albumId;
        $this->title = $title;
        $this->url = $url;
    }

    public function getTrackId(): int
    {
        return $this->trackId;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}