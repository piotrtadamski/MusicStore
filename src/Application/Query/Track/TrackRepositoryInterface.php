<?php

namespace MusicStore\Application\Query\Track;

interface TrackRepositoryInterface
{
    /** @return TrackQueryResult[] */
    public function findAll(): array;
    public function get(int $id): TrackQueryResult;
}