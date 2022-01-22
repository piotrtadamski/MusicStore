<?php

namespace MusicStore\Application\Query\Album;

interface AlbumRepositryInterface
{
    /** @return OutputAlbum[] */
    public function findAll(): array;
    public function get(int $id): OutputAlbum;
}