<?php

namespace MusicStore\Domain\Album;

use Doctrine\ORM\Mapping as ORM;
use MusicStore\Domain\Common\Types\Title;
use MusicStore\Domain\Common\Types\Year;

/**
 * @ORM\Entity
 */
class Album
{
    /** @ORM\Id() @ORM\Column(type="integer") @ORM\GeneratedValue() */
    private int $id;

    /** @ORM\Column(type="title") */
    private Title $title;

    /** @ORM\Column(type="year") */
    private Year $year;

    public function __construct(int $id, Title $title, Year $year)
    {
        $this->id = $id;
        $this->title = $title;
        $this->year = $year;
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
}
