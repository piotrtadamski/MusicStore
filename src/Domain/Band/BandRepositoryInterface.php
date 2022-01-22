<?php

namespace MusicStore\Domain\Band;

interface BandRepositoryInterface
{
    /**
     * @return Band[]
     */
    public function findAll(): array;
    public function get(int $id): Band;
    public function save(Band $band);
}