<?php

namespace MusicStore\Infrastructure\Adapters\Doctrine\DomainModel;

use Doctrine\ORM\EntityManagerInterface;
use MusicStore\Domain\Track\Track;
use MusicStore\Domain\Track\TrackNotFoundException;
use MusicStore\Domain\Track\TrackRepositoryInterface;

class TrackRepository implements TrackRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function findAll(): array
    {
        return $this->entityManager->getRepository(Track::class)->findAll();
    }

    public function get(int $id): Track
    {
        if( null !== ($track = $this->entityManager->getRepository(Track::class)->find($id))) {
            return $track;
        }
        throw new TrackNotFoundException();
    }

    public function save(Track $track)
    {
        $this->entityManager->persist($track);
        return $track;
    }
}