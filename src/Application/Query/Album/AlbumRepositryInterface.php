<?php

namespace MusicStore\Application\Query\Album;

interface AlbumRepositryInterface
{
    /** @return AlbumQueryResult[] */
    public function findAll(): array;
    public function get(int $id): AlbumQueryResult;
}