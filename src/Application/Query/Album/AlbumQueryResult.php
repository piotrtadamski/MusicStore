<?php

namespace MusicStore\Application\Query\Album;

class AlbumQueryResult
{
    private string $title;
    private string $year;
    private int $bandId;

    public function __construct(string $title, string $year, int $bandId)
    {
        $this->title = $title;
        $this->year = $year;
        $this->bandId = $bandId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function getBandId(): int
    {
        return $this->bandId;
    }
}