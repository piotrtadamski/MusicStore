<?php

namespace MusicStore\Application\Query\Band;

interface BandRepositryInterface
{
    /** @return BandQueryResult[] */
    public function findAll(): array;
    public function get(int $id): BandQueryResult;
}