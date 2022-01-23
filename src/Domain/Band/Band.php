<?php

namespace MusicStore\Domain\Band;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use MusicStore\Domain\Album\Album;

/**
 * @ORM\Entity
 * @ORM\Table(name="bands")
 */
class Band implements \JsonSerializable
{
    /** @ORM\Id() @ORM\Column(type="integer") @ORM\GeneratedValue() */
    private int $id;

    /** @ORM\Column(type="band_name") */
    private BandName $bandName;

    /**
     * @ORM\OneToMany(targetEntity="MusicStore\Domain\Album\Album", mappedBy="band")
     */
    private Collection $albums;

    public function __construct(BandName $bandName)
    {
        $this->bandName = $bandName;
        $this->albums = new ArrayCollection();
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

    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public static function create(BandName $bandName): self
    {
        return new self($bandName);
    }

    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->setBand($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        $this->albums->removeElement($album);

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getBandName()
        ];
    }
}
