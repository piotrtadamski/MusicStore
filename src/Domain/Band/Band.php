<?php

namespace MusicStore\Domain\Band;

use Doctrine\ORM\Mapping as ORM;
use MusicStore\Domain\Band\Types\BandName;

/**
 * @ORM\Entity
 */
class Band
{
    /** @ORM\Id() @ORM\Column(type="integer") @ORM\GeneratedValue() */
    private int $id;

    /** @ORM\Column(type="band_name") */
    private BandName $bandName;

    public function __construct(int $id, BandName $bandName)
    {
        $this->id = $id;
        $this->bandName = $bandName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getBandName(): BandName
    {
        return $this->bandName;
    }

    public function setBandName(BandName $bandName): void
    {
        $this->bandName = $bandName;
    }
}
