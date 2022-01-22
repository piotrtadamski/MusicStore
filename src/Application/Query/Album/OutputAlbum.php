<?php

namespace MusicStore\Application\Query\Album;

class OutputAlbum
{
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

    public static function create(string $title, string $year)
    {
        return new static($title, $year);
    }
}