<?php

namespace MusicStore\Application\Query\Album;

class AlbumQueryResult
{
    private string $title;
    private string $year;

    public function __construct(string $title, string $year)
    {
        $this->title = $title;
        $this->year = $year;
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