<?php

namespace MusicStore\Domain\Track;

interface TrackRepositoryInterface
{
    /**
     * @return Track[]
     */
    public function findAll(): array;
    public function get(int $id): Track;
    public function save(Track $track);
    public function remove(Track $track);
}