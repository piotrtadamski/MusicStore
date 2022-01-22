<?php

namespace MusicStore\Application\Query\Track;

class TrackQueryResult
{
    private string $title;
    private string $url;
    private int $albumId;

    public function __construct(string $title, string $url, int $albumId)
    {
        $this->title = $title;
        $this->url = $url;
        $this->albumId = $albumId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }
}