<?php

namespace MusicStore\Domain\Common\Types;

class Url
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public static function fromString(string $value)
    {
        return new self($value);
    }

    public function __toString()
    {
        return $this->url;
    }
}