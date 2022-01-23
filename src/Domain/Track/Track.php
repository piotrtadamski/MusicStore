<?php

namespace MusicStore\Domain\Track;

use Doctrine\ORM\Mapping as ORM;
use MusicStore\Domain\Album\Album;
use MusicStore\Domain\Common\Types\Title;
use MusicStore\Domain\Common\Types\Url;

/**
 * @ORM\Entity
 * @ORM\Table(name="tracks")
 */
class Track
{
    /** @ORM\Id() @ORM\Column(type="integer") @ORM\GeneratedValue() */
    private int $id;

    /** @ORM\Column(type="title") */
    private Title $title;

    /** @ORM\Column(type="url") */
    private Url $url;

    /**
     * @ORM\ManyToOne(targetEntity="MusicStore\Domain\Album\Album", inversedBy="tracks")
     * @ORM\JoinColumn(name="album_id", referencedColumnName="id")
     */
    private Album $album;

    public function __construct(Title $title, Url $url, Album $album)
    {
        $this->title = $title;
        $this->url = $url;
        $this->album = $album;
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

    public function getAlbum(): Album
    {
        return $this->album;
    }

    public function setAlbum(Album $album): void
    {
        $this->album = $album;
    }

    public static function create(Title $title, Url $url, Album $album): self
    {
        return new self($title, $url, $album);
    }
}
