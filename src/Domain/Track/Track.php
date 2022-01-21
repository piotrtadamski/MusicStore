<?php

namespace MusicStore\Domain\Track;

use Doctrine\ORM\Mapping as ORM;
use MusicStore\Domain\Common\Types\Title;
use MusicStore\Domain\Common\Types\Url;

/**
 * @ORM\Entity
 */
class Track
{
    /** @ORM\Id() @ORM\Column(type="integer") @ORM\GeneratedValue() */
    private int $id;

    /** @ORM\Column(type="title") */
    private Title $title;

    /** @ORM\Column(type="url") */
    private Url $url;

    public function __construct(int $id, Title $title, Url $url)
    {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getUrl(): Url
    {
        return $this->url;
    }

    public function setTitle(Title $title): void
    {
        $this->title = $title;
    }

    public function setUrl(Url $url): void
    {
        $this->url = $url;
    }
}
