<?php

namespace MusicStore\Infrastructure\Adapters\Doctrine\DomainModel;

use Doctrine\ORM\EntityManagerInterface;
use MusicStore\Domain\Band\Band;
use MusicStore\Domain\Band\BandNotFoundException;
use MusicStore\Domain\Band\BandRepositoryInterface;

class BandRepository implements BandRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findAll(): array
    {
        return $this->entityManager->getRepository(Band::class)->findAll();
    }

    public function get(int $id): Band
    {
        if( null !== ($band = $this->entityManager->getRepository(Band::class)->find($id))) {
            return $band;
        }

        throw new BandNotFoundException();
    }

    public function save(Band $band)
    {
        $this->entityManager->persist($band);
        return $band;
    }
}