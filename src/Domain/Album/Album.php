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
    private int $id;
    private Title $title;
    private Year $year;

    public function __construct(int $id, Title $title, Year $year)
    {
        $this->id = $id;
        $this->title = $title;
        $this->year = $year;
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
     * @return Year
     */
    public function getYear(): Year
    {
        return $this->year;
    }

    /**
     * @param Title $title
     */
    public function setTitle(Title $title): void
    {
        $this->title = $title;
    }

    /**
     * @param Year $year
     */
    public function setYear(Year $year): void
    {
        $this->year = $year;
    }
}
