<?php

namespace MusicStore\Application\Query\Track;

interface TrackRepositoryInterface
{
    /** @return OutputTrack[] */
    public function findAll(): array;
    public function get(int $id): OutputTrack;
}