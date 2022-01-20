<?php

namespace MusicStore\Domain\Common\Types;

class Title
{
    private string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public static function fromString(string $value)
    {
        return new self($value);
    }

    public function __toString()
    {
        return $this->title;
    }
}