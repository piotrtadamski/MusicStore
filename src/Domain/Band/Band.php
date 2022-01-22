<?php

namespace MusicStore\Domain\Band;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="bands")
 */
class Band
{
    /** @ORM\Id() @ORM\Column(type="integer") @ORM\GeneratedValue() */
    private int $id;

    /** @ORM\Column(type="band_name") */
    private BandName $bandName;

    public function __construct(BandName $bandName)
    {
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

    public static function create(BandName $bandName): self
    {
        return new self($bandName);
    }
}
