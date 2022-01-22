<?php

namespace MusicStore\Domain\Album;

interface AlbumRepositoryInterface
{
    /**
     * @return Album[]
     */
    public function findAll(): array;
    public function get(int $id): Album;
    public function save(Album $album): Album;
    public function remove(Album $track);

}