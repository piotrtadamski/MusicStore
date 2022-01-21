<?php

namespace MusicStore\Domain\Band;

use Doctrine\ORM\Mapping as ORM;
use MusicStore\Domain\Common\Types\BandName;

/**
 * @ORM\Entity
 */
class Band
{
    /**
     * @ORM\Id() @ORM\Column(type="integer") @ORM\GeneratedValue()
     * @var int
     */
    private int $id;
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
