<?php

namespace MusicStore\Application\Query\Track;

class OutputTrack
{
    private string $title;
    private string $url;

    public function __construct(string $title, string $url)
    {
        $this->title = $title;
        $this->url = $url;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public static function create(string $title, string $url)
    {
        return new self($title, $url);
    }
}