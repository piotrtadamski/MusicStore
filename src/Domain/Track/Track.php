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
    private int $id;
    private Title $title;
    private Url $url;

    public function __construct(int $id, Title $title, Url $url)
    {
        $this->id = $id;
        $this->title = $title;
        $this->url = $url;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Title
     */
    public function getTitle(): Title
    {
        return $this->title;
    }

    /**
     * @return Url
     */
    public function getUrl(): Url
    {
        return $this->url;
    }

    /**
     * @param Title $title
     */
    public function setTitle(Title $title): void
    {
        $this->title = $title;
    }

    /**
     * @param Url $url
     */
    public function setUrl(Url $url): void
    {
        $this->url = $url;
    }
}
