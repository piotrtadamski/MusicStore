<?php

namespace MusicStore\Domain\Album;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use MusicStore\Domain\Band\Band;
use MusicStore\Domain\Common\Types\Title;
use MusicStore\Domain\Common\Types\Year;
use MusicStore\Domain\Track\Track;

/**
 * @ORM\Entity
 * @ORM\Table(name="albums")
 */
class Album implements \JsonSerializable
{
    /** @ORM\Id() @ORM\Column(type="integer") @ORM\GeneratedValue() */
    private int $id;

    /** @ORM\Column(type="title") */
    private Title $title;

    /** @ORM\Column(type="year") */
    private Year $year;

    /**
     * @ORM\ManyToOne(targetEntity="MusicStore\Domain\Band\Band", inversedBy="albums")
     * @ORM\JoinColumn(name="band_id", referencedColumnName="id")
     */
    private Band $band;

    /**
     * @ORM\OneToMany(targetEntity="MusicStore\Domain\Track\Track", mappedBy="album")
     */
    private Collection $tracks;

    public function __construct(Title $title, Year $year, Band $band)
    {
        $this->title = $title;
        $this->year = $year;
        $this->band = $band;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): Title
    {
        return $this->title;
    }

    public function getYear(): Year
    {
        return $this->year;
    }

    public function setTitle(Title $title): void
    {
        $this->title = $title;
    }

    public function setYear(Year $year): void
    {
        $this->year = $year;
    }

    public function getBand(): Band
    {
        return $this->band;
    }

    public function setBand(Band $band): void
    {
        $this->band = $band;
    }

    public static function create(Title $title, Year $year, Band $band)
    {
        return new self($title, $year, $band);
    }

    public function jsonSerialize()
    {
        return [
          'id' => $this->getId(),
            'title' => $this->getTitle(),
            'band' => $this->getBand()
        ];
    }

    public function getTracks(): Collection
    {
        return $this->tracks;
    }

    public function addTrack(Track $track): self
    {
        if (!$this->tracks->contains($track)) {
            $this->tracks[] = $track;
            $track->setBand($this);
        }

        return $this;
    }

    public function removeTrack(Track $track): self
    {
        $this->tracks->removeElement($track);

        return $this;
    }
}
