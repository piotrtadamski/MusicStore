<?php

namespace MusicStore\Application\Command\Album;

class EditAlbum
{
    private int $albumId;
    private int $bandId;
    private string $title;
    private string $year;

    public function __construct(int $albumId, int $bandId, string $title, string $year)
    {
        $this->albumId = $albumId;
        $this->bandId = $bandId;
        $this->title = $title;
        $this->year = $year;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function getBandId(): int
    {
        return $this->bandId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getYear(): string
    {
        return $this->year;
    }
}